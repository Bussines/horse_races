<?php

namespace App\Repository;

use App\Entity\Horse;
use App\Entity\Race;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Horse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Horse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Horse[]    findAll()
 * @method Horse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorseRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Horse::class);
    }

    /**
     * @return Horse
     * @throws \Doctrine\ORM\ORMException
     */
    public function createHorse()
    {
        $entityManager= $this->getEntityManager();
        $horse = new Horse();
        $horse->setName($this->generateRandomString());
        $horse->setSpeed($this->generate_random_0_10());
        $horse->setStrength($this->generate_random_0_10());
        $horse->setEndurance($this->generate_random_0_10());
        $entityManager->persist($horse);
        $entityManager->flush();
        return $horse;
    }

    public function generate_random_0_10()
    {
        return round(((float)rand() / (float)getrandmax())*10,2);
    }

    /**
     * @param int $length
     * @return string
     */
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return 'Horse_'.$randomString;
    }

    public function getHorseSpeedByIds($ids): ?array
    {
        $qb = $this->createQueryBuilder('horse')
            ->select('`horse`.`id`, `horse`.`speed`')
            ->where('`horse`.`id` IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery();
        $horseSpeeds= $qb->execute();
        return $horseSpeeds;
    }

    public function getHorseEnduranceByIds($ids):?array
    {
        $qb = $this->createQueryBuilder('horse')
            ->select('`horse`.`id`, `horse`.`endurance`')
            ->where('`horse`.`id` IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery();
        $horseEndurance =$qb->execute();
        return $horseEndurance;
    }

    /**
     * @param $id
     * @return bool|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteHorseById($id): ?array
    {
        $horse =$this->find($id);
        if (!isset($horse)) {
            return array('result'=>false,'error'=>true, 'message'=>'Horse cannot be deleted');
        }
        $this->getEntityManager()->remove($horse);
        $this->getEntityManager()->flush();
        return array('result'=>true,'error'=>false, 'message'=>'Horse deleted successfully');
    }

}
