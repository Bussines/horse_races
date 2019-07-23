<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceHorseRepository")
 */
class RaceHorse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Race", inversedBy="horseId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $raceId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Horse", inversedBy="raceHorseObject")
     * @ORM\JoinColumn(nullable=false)
     */
    private $horseId;

    /**
     * @ORM\Column(type="float")
     */
    private $position;

    /**
     * @ORM\Column(type="integer")
     */
    private $time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaceId(): ?Race
    {
        return $this->raceId;
    }

    public function setRaceId(?Race $raceId): self
    {
        $this->raceId = $raceId;

        return $this;
    }

    public function getHorseId(): ?Horse
    {
        return $this->horseId;
    }

    public function setHorseId(?Horse $horseId): self
    {
        $this->horseId = $horseId;

        return $this;
    }

    public function getPosition(): ?float
    {
        return $this->position;
    }

    public function setPosition(float $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }
}
