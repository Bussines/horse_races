<?php


namespace App\Service;
use App\Entity\Horse;
use App\Entity\Race;
use \App\Repository\RaceHorseRepository;
use Doctrine\ORM\EntityNotFoundException;
use http\Exception\InvalidArgumentException;


class RaceHorseService
{
    const PROGRESS_TIME=10;

    const RACE_METER_LENGTH=1500;
    /**
     * @var RaceHorseRepository
     */
    private $raceHorseDao;

    /**
     * @var HorseService
     */
    private $horseService;

    /**
     * @var RaceService
     */
    private $raceService;

    /**
     * RaceHorseService constructor.
     * @param RaceHorseRepository $raceHorseRepository
     * @param HorseService $horseService
     * @param RaceService $raceService
     */
    public function __construct(RaceHorseRepository $raceHorseRepository, HorseService $horseService, RaceService $raceService)
    {
        $this->raceHorseDao=$raceHorseRepository;
        $this->horseService=$horseService;
        $this->raceService=$raceService;
    }

    /**
     * @return array|null
     * @throws \Doctrine\ORM\ORMException
     */
    public function createNewRace(): ?array
    {
        $horses = $this->horseService->createHorse(8);
        $race= $this->raceService->createRace();
        $this->subscribeHorseToRace($horses,$race);
        return(array('race'=>$race,'horses'=>$horses));
    }

    /**
     * @param array Horse $horses
     * @param Race $race
     */
    public function subscribeHorseToRace($horses,$race)
    {
        foreach ($horses as $horse)
        {
            $this->raceHorseDao->subscribeHorseToRace($race,$horse);
        }
    }

    /**
     * @return array
     */
    public function findOngoingRaces()
    {
        $raceHorses= $this->raceHorseDao->findOngoingRaces();
        $horseRaceData=$this->prepareHorseData($raceHorses);
        return $horseRaceData;
    }

    /**
     * @param int $raceCount
     * @param int $horseCount
     * @return mixed
     */
    public function findFinishedRaces($raceCount=5,$horseCount=3)
    {
        $raceDataArr=array();
        $races= $this->raceService->findFinishedRaces($raceCount);
        foreach ($races as $race)
        {
            $horses = $this->raceHorseDao->findHorsesByRaceId($race->getId(),$horseCount);
            $raceData = $this->prepareHorseData($horses);
            $raceDataArr[$race->getId()]=$raceData[$race->getId()];
        }
        return $raceDataArr;
    }


    /**
     * @param $raceHorses
     * @return array
     */
    private function prepareHorseData($raceHorses)
    {
        $horseRaceData = array();
        foreach ($raceHorses as $key=>$raceHorse)
        {
            $raceId = $raceHorse['raceId'];
            if(!in_array($raceId,$horseRaceData))
            {
                $horseRaceData[$raceId]['raceId']=$raceId;
                $horseRaceData[$raceId]['raceTime']=isset($raceHorse['raceTime'])? $raceHorse['raceTime'] :'';
                $horseRaceData[$raceId]['raceStatus']=isset($raceHorse['raceStatus'])? $raceHorse['raceStatus'] :'';
            }
            $horseId= $raceHorse['horseId'];
            $horseRaceData[$raceId]['horses'][$horseId]['horseDistanceCovered']=$raceHorse['horseDistanceCovered'];
            $horseRaceData[$raceId]['horses'][$horseId]['horseTime']=$raceHorse['horseTime'];
            $horseRaceData[$raceId]['horses'][$horseId]['horseName']=$raceHorse['horseName'];
        }
        return $horseRaceData;
    }

    /**
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function progressOngoingRaces()
    {
        $ongoingRaces = $this->findOngoingRaces();
        foreach ($ongoingRaces as $ongoingRace)
        {
            $raceId=$ongoingRace['raceId'];
            $ongoingRace['horses']=$this->updateHorsePositions($raceId,$ongoingRace['horses']);
            $this->updateRace($raceId,Race::STATUS_IN_PROGRESS,self::PROGRESS_TIME);
        }
        return true;

    }

    /**
     * @param $raceId
     * @param $horses
     * @return array
     */
    public function updateHorsePositions($raceId,$horses)
    {
        foreach ($horses as $horseId=>&$horse)
        {
            $horse=(object)$horse;
            if($horse->horseDistanceCovered>=self::RACE_METER_LENGTH)
            {
                continue;
            }
            $horseSpeed=$this->horseService->getHorseSpeedById($horseId);
            $horseEndurance = $this->horseService->getHorseEnduranceMetersById($horseId);
            $nextPosition = (int)($horse->horseDistanceCovered + $horseSpeed * self::PROGRESS_TIME);
            $slowedSpeed=$afterEnduranceTime=0;
            if($nextPosition >= $horseEndurance)
            {
                $slowedSpeed = $this->horseService->getHorseSlowedSpeedById($horseId);
                $afterEnduranceTime = (int)(($nextPosition - $horseEndurance) / $horseSpeed);
                $nextPosition -= $afterEnduranceTime * ($horseSpeed - $slowedSpeed);
            }
            if($nextPosition>=self::RACE_METER_LENGTH)
            {
                $extraLength = $nextPosition-self::RACE_METER_LENGTH;
                $extraTime=(int)(($extraLength)/$slowedSpeed+$horseSpeed);
                $nextPosition=self::RACE_METER_LENGTH;
                $horse->horseTime+= self::PROGRESS_TIME-$extraTime;
            }
            else{
                $horse->horseTime+= self::PROGRESS_TIME;
            }
            $horse->horseDistanceCovered = $nextPosition;
            $this->raceHorseDao->updateHorsePositionInRace($raceId,$horseId,$horse->horseDistanceCovered, $horse->horseTime);
        }
        return (array)$horses;
    }

    /**
     * @param $raceId
     * @param $status
     * @param $time
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateRace($raceId,$status,$time)
    {
        if($this->isRaceFinished($raceId))
        {
            $status=Race::STATUS_FINISHED;
        }
        $this->raceService->updateRace($raceId,$status,$time);
    }

    /**
     * @param $raceId
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isRaceFinished($raceId)
    {
        return $this->raceHorseDao->isRaceFinished($raceId);
    }

    /**
     * @return mixed
     */
    public function findBestResult()
    {
        return $this->raceHorseDao->findBestResult();
    }
}