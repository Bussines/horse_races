<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use http\Exception\InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceRepository")
 */
class Race
{

    const STATUS_IN_PROGRESS= 'in_progress';
    const STATUS_FINISHED = 'finished';
    const STATUS_READY_TO_START = 'ready_to_start';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RaceHorse", mappedBy="raceId", orphanRemoval=true)
     */
    private $raceHorseObject;

    public function __construct()
    {
        $this->raceHorseObject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if (!in_array($status, array(self::STATUS_IN_PROGRESS, self::STATUS_FINISHED,self::STATUS_READY_TO_START))) {
            throw new InvalidArgumentException("Invalid status");
        }
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|RaceHorse[]
     */
    public function getRaceHorseObject(): Collection
    {
        return $this->raceHorseObject;
    }

    public function addHorseId(RaceHorse $horseId): self
    {
        if (!$this->raceHorseObject->contains($horseId)) {
            $this->raceHorseObject[] = $horseId;
            $horseId->setRaceId($this);
        }

        return $this;
    }

    public function removeHorseId(RaceHorse $horseId): self
    {
        if ($this->raceHorseObject->contains($horseId)) {
            $this->raceHorseObject->removeElement($horseId);
            // set the owning side to null (unless already changed)
            if ($horseId->getRaceId() === $this) {
                $horseId->setRaceId(null);
            }
        }

        return $this;
    }
}
