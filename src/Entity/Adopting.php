<?php

namespace App\Entity;

use App\Repository\AdoptingRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @ORM\Entity(repositoryClass=AdoptingRepository::class)
 * @Entity
 */
class Adopting extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=AdoptingRequest::class, inversedBy="adopting")
     */
    private $adoptingRequest;

    public function getAdoptingRequest(): ?AdoptingRequest
    {
        return $this->adoptingRequest;
    }

    public function setAdoptingRequest(?AdoptingRequest $adoptingRequest): self
    {
        $this->adoptingRequest = $adoptingRequest;

        return $this;
    }
}