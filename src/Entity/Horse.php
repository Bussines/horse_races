<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HorseRepository")
 */
class Horse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 0,
     *      max = 10,
     *      minMessage = "You must be at least {{ limit }}",
     *      maxMessage = "You cannot be taller than {{ limit }}"
     * )
     */
    private $speed;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 0,
     *      max = 10,
     *      minMessage = "You must be at least {{ limit }}",
     *      maxMessage = "You cannot be taller than {{ limit }}"
     * )
     */
    private $strength;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 0,
     *      max = 10,
     *      minMessage = "You must be at least {{ limit }}",
     *      maxMessage = "You cannot be taller than {{ limit }}"
     * )
     */
    private $endurance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RaceHorse", mappedBy="horseId", orphanRemoval=true)
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSpeed(): ?float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getStrength(): ?float
    {
        return $this->strength;
    }

    public function setStrength(float $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getEndurance(): ?float
    {
        return $this->endurance;
    }

    public function setEndurance(float $endurance): self
    {
        $this->endurance = $endurance;

        return $this;
    }

    /**
     * @return Collection|RaceHorse[]
     */
    public function getRaceHorseObject(): Collection
    {
        return $this->raceHorseObject;
    }

    public function addRaceHorseObject(RaceHorse $raceHorseObject): self
    {
        if (!$this->raceHorseObject->contains($raceHorseObject)) {
            $this->raceHorseObject[] = $raceHorseObject;
            $raceHorseObject->setHorseId($this);
        }

        return $this;
    }

    public function removeRaceHorseObject(RaceHorse $raceHorseObject): self
    {
        if ($this->raceHorseObject->contains($raceHorseObject)) {
            $this->raceHorseObject->removeElement($raceHorseObject);
            // set the owning side to null (unless already changed)
            if ($raceHorseObject->getHorseId() === $this) {
                $raceHorseObject->setHorseId(null);
            }
        }

        return $this;
    }
}
