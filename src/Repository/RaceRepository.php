<?php

namespace App\Repository;

use App\Entity\Race;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityNotFoundException;
/**
 * @method Race|null find($id, $lockMode = null, $lockVersion = null)
 * @method Race|null findOneBy(array $criteria, array $orderBy = null)
 * @method Race[]    findAll()
 * @method Race[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Race::class);
    }

    /**
     * @return array|null
     */
    public function findOngoingRaces():?array
    {
        $result = $this->createQueryBuilder('race')
            ->where('race.status = :status')
            ->setParameter('status', Race::STATUS_IN_PROGRESS)
            ->orderBy('race.id', 'DESC')
            ->getQuery()
            ->getResult();
        return $result;

    }

    /**
     * @param $count
     * @return array|null
     */
    public function findFinishedRaces($count):?array
    {
        $qb = $this->createQueryBuilder('race')
            ->where('race.status = :status')
            ->orderBy('race.id', 'DESC')
            ->setMaxResults($count)
            ->setParameter('status',Race::STATUS_FINISHED)
            ->getQuery();
        return $qb->execute();

    }

    /**
     * @return Race
     * @throws \Doctrine\ORM\ORMException
     */
    public function createRace()
    {
        $entityManager= $this->getEntityManager();
        $race = new Race();
        $race->setTimestamp(0);
        $race->setStatus(Race::STATUS_READY_TO_START);
        $entityManager->persist($race);
        $entityManager->flush();
        return $race;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isMaximumOngoingRaceMet()
    {
        $result= $this->createQueryBuilder('race')
            ->andWhere('race.status <> :status')
            ->setParameter('status', Race::STATUS_FINISHED)
            ->select('count(race.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $result;
    }


    /**
     * @param $raceDto
     * @param $status
     * @param $time
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateRace($raceDto,$status,$time)
    {
        $em = $this->getEntityManager();
        $raceDto->setTimestamp($time);
        $raceDto->setStatus($status);
        $em->persist($raceDto);
        $em->flush();
        return $raceDto;
    }

}
