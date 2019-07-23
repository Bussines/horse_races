<?php

namespace App\Service;

use App\Entity\Horse;
use \App\Repository\HorseRepository;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
final class HorseService
{

    const HORSE_BASE_SPEED=5;

    const HORSE_BASE_SLOWDOWN=5;

    const HORSE_STRENGTH_COEFFICIENT=0.08;

    const ENDURANCE_METER=100;
    /**
     * @var HorseRepository
     */
    private $horseDao;

    /**
     * HorseService constructor.
     * @param HorseRepository $horseRepository
     */
    public function __construct(HorseRepository $horseRepository)
    {
        $this->horseDao=$horseRepository;
    }

    /**
     * @param int $count
     * @return array|null
     * @throws \Doctrine\ORM\ORMException
     */
    public function createHorse($count=8): ?array
    {
        if($count<=0)
        {
            throw new InvalidArgumentException('actionId must not be null');
        }
        $horsesArr=array();
        for ($i=0;$i<$count;$i++) {
            $horsesArr[]= $this->horseDao->createHorse();
        }
        return $horsesArr;
    }

    /**
     * @param $id
     * @return array|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteHorseById($id): ?array
    {
        return $this->horseDao->deleteHorseById($id);
    }

    /**
     * @return array|null
     */
    public function findAllHorses(): ?array
    {
        return $this->horseDao->findAll();
    }

    /**
     * @param $horseId
     * @return Horse|null
     */
    public function findHorseById($horseId)
    {
        return $this->horseDao->find($horseId);
    }

    public function getHorseEnduranceMetersById($horseId)
    {
        $horseDto=$this->findHorseById($horseId);
        return $horseDto->getEndurance() * self::ENDURANCE_METER;
    }

    public function getHorseSpeedById($horseId)
    {
        $horseDto=$this->findHorseById($horseId);
        return self::HORSE_BASE_SPEED+$horseDto->getSpeed();
    }

    /**
     * @param $horseId
     * @return float|int|null
     */
    public function getHorseSlowedSpeedById($horseId)
    {
        $horseDto=$this->findHorseById($horseId);
        $horseSpeed= $this->getHorseSpeedById($horseId);
        $speedReduction = 5 - ($horseDto->getStrength()*self::HORSE_STRENGTH_COEFFICIENT);
        return $horseSpeed-(self::HORSE_BASE_SLOWDOWN - $speedReduction );
    }

}