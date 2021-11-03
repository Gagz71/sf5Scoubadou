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
     * @ORM\OneToMany(targetEntity=AdoptingRequest::class, mappedBy="adopting")
     */
    private $adoptingRequest;

    /**
     * @return mixed
     */
    public function getAdoptingRequest()
    {
        return $this->adoptingRequest;
    }

    /**
     * @param mixed $adoptingRequest
     */
    public function setAdoptingRequest($adoptingRequest): void
    {
        $this->adoptingRequest = $adoptingRequest;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = parent::getRoles();
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ADOPTING';

        return array_unique($roles);
    }
}
