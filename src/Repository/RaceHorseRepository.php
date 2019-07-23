<?php

namespace App\Repository;

use App\Entity\Horse;
use App\Entity\Race;
use App\Entity\RaceHorse;
use App\Service\RaceHorseService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RaceHorse|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaceHorse|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaceHorse[]    findAll()
 * @method RaceHorse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceHorseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RaceHorse::class);
    }

    public function subscribeHorseToRace($raceId,$horseId)
    {
        $entityManager= $this->getEntityManager();
        $raceHorse = new RaceHorse();
        $raceHorse->setRaceId($raceId);
        $raceHorse->setHorseId($horseId);
        $raceHorse->setPosition(0);
        $raceHorse->setTime(0);
        $entityManager->persist($raceHorse);
        $entityManager->flush();
        return $raceHorse;
    }

    /**
     * @return mixed
     */
    public function findOngoingRaces()
    {
       $result= $this->createQueryBuilder('horseRace')
            ->innerJoin('horseRace.horseId','h')
            ->addSelect('h')
            ->innerJoin('horseRace.raceId','r')
            ->andWhere('r.status <> :status')
            ->setParameter('status', Race::STATUS_FINISHED)
            ->select('horseRace.id, r.id as raceId, r.timestamp as raceTime, r.status as raceStatus, horseRace.position as horseDistanceCovered,horseRace.time as horseTime, h.name as horseName, h.id as horseId')
            ->orderBy('horseRace.position','DESC')
            ->addOrderBy('horseRace.time','ASC')
            ->getQuery()
            ->getResult();

        return $result;
    }


    /**
     * @param $raceId
     * @param $horseId
     * @param $horsePosition
     * @param $horseTime
     * @return mixed
     */
    public function updateHorsePositionInRace($raceId,$horseId,$horsePosition, $horseTime)
    {
        $result= $this->createQueryBuilder('horseRace')
            ->update()
            ->set('horseRace.position', ':horsePosition')
            ->setParameter('horsePosition', $horsePosition)
            ->set('horseRace.time', ':horseTime')
            ->setParameter('horseTime', $horseTime)
            ->where('horseRace.raceId = :raceId')
            ->setParameter('raceId', $raceId)
            ->andWhere('horseRace.horseId = :horseId')
            ->setParameter('horseId', $horseId)
            ->getQuery()
            ->getResult();
        return $result;
    }

    /**
     * @param $raceId
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isRaceFinished($raceId)
    {
        $result= $this->createQueryBuilder('horseRace')
            ->select('count(horseRace)')
            ->where('horseRace.raceId = :raceId')
            ->setParameter('raceId', $raceId)
            ->andWhere('horseRace.position < :raceLength')
            ->setParameter('raceLength', RaceHorseService::RACE_METER_LENGTH)
            ->getQuery()
            ->getSingleScalarResult();

        if($result>0)
        {
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findBestResult()
    {
        $result= $this->createQueryBuilder('horseRace')
            ->innerJoin('horseRace.horseId','h')
            ->addSelect('h')
            ->andWhere('horseRace.position =:raceLength')
            ->setParameter('raceLength', RaceHorseService::RACE_METER_LENGTH)
            ->select('horseRace.id, horseRace.time as horseTime, 
            h.name as horseName, h.speed as horseSpeed, h.strength as horseStrength, h.endurance as horseEndurance')
            ->setMaxResults(1)
            ->orderBy('horseRace.time','ASC')
            ->getQuery()
            ->getOneOrNullResult();

        return $result;
    }

    /**
     * @param $raceId
     * @param $count
     * @return mixed
     */
    public function findHorsesByRaceId($raceId,$count)
    {
        $result= $this->createQueryBuilder('horseRace')
            ->innerJoin('horseRace.horseId','h')
            ->addSelect('h')
            ->andWhere('horseRace.raceId = :raceId')
            ->setParameter('raceId', $raceId)
            ->select('IDENTITY (horseRace.raceId) as raceId, horseRace.position as horseDistanceCovered,horseRace.time as horseTime, h.name as horseName, h.id as horseId')
            ->orderBy('horseRace.position','DESC')
            ->setMaxResults($count)
            ->addOrderBy('horseRace.time','ASC')
            ->getQuery()
            ->getResult();

        return $result;
    }
}
