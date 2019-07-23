<?php


namespace App\Service;
use App\Entity\Race;
use \App\Repository\RaceRepository;

class RaceService
{
    const MAXIMUM_CONCURRENT_RACE=3;
    const TIME_PROGRESS=10;
    /**
     * @var RaceRepository
     */
    private $raceDao;

    /**
     * RaceService constructor.
     * @param RaceRepository $raceRepository
     */
    public function __construct( RaceRepository $raceRepository)
    {
        $this->raceDao=$raceRepository;
    }

    /**
     * @return Race
     * @throws \Doctrine\ORM\ORMException
     */
    public function createRace(): ?Race
    {
        $race = $this->raceDao->createRace();
        return $race;
    }

    /**
     * @return array|null
     */
    public function findOngoingRaces(): ?array
    {
        $races = $this->raceDao->findOngoingRaces();
        return $races;

    }

    /**
     * @return bool|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isMaximumOngoingRaceMet(): ?bool
    {
        $ongoingRaceNumber=$this->raceDao->isMaximumOngoingRaceMet();
        if(isset($ongoingRaceNumber) && $ongoingRaceNumber>=self::MAXIMUM_CONCURRENT_RACE)
        {
            return false;
        }
        return true;
    }

    /**
     * @param $raceId
     * @param $status
     * @param $time
     */
    public function updateRace($raceId,$status,$time)
    {
        $raceDto=$this->findOngoingRaceById($raceId);
        $time=$raceDto->getTimestamp()+$time;
        $this->raceDao->updateRace($raceDto,$status,$time);
    }

    /**
     * @param $id
     * @return Race|null
     */
    public function findOngoingRaceById($id)
    {
        $raceDto= $this->raceDao->find($id);

        if (!isset($raceDto)) {
            throw new EntityNotFoundException('Unable to find race entity.');
        }
        else if($raceDto->getStatus()==Race::STATUS_FINISHED)
        {
            throw new InvalidArgumentException('Unable to find race entity.');
        }
        return $raceDto;
    }

    /**
     * @param $count
     * @return mixed
     */
    public function findFinishedRaces($count)
    {
        $races = $this->raceDao->findFinishedRaces($count);
        return $races;
    }

}