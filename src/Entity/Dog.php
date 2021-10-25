<?php

namespace App\Entity;

use App\Repository\DogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DogRepository::class)
 */
class Dog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $race = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $antecedents;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lof;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullDescription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sociable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdopted;

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

    public function getRace(): ?array
    {
        return $this->race;
    }

    public function setRace(array $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getAntecedents(): ?string
    {
        return $this->antecedents;
    }

    public function setAntecedents(string $antecedents): self
    {
        $this->antecedents = $antecedents;

        return $this;
    }

    public function getLof(): ?bool
    {
        return $this->lof;
    }

    public function setLof(bool $lof): self
    {
        $this->lof = $lof;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    public function getSociable(): ?bool
    {
        return $this->sociable;
    }

    public function setSociable(bool $sociable): self
    {
        $this->sociable = $sociable;

        return $this;
    }

    public function getIsAdopted(): ?bool
    {
        return $this->isAdopted;
    }

    public function setIsAdopted(bool $isAdopted): self
    {
        $this->isAdopted = $isAdopted;

        return $this;
    }
}
