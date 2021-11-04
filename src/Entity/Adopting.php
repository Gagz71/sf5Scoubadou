<?php

namespace App\Entity;

use App\Repository\AdoptingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $adoptingRequests;

    public function __construct()
    {
        parent::__construct();
        $this->adoptingRequests = new ArrayCollection();
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

    /**
     * @return Collection|AdoptingRequest[]
     */
    public function getAdoptingRequest(): Collection
    {
        return $this->adoptingRequests;
    }

    public function addAdoptingRequest(AdoptingRequest $adoptingRequest): self
    {
        if (!$this->adoptingRequests->contains($adoptingRequest)) {
            $this->adoptingRequests[] = $adoptingRequest;
            $adoptingRequest->setAdopting($this);
        }

        return $this;
    }

    public function removeAdoptingRequest(AdoptingRequest $adoptingRequest): self
    {
        if ($this->adoptingRequests->removeElement($adoptingRequest)) {
            // set the owning side to null (unless already changed)
            if ($adoptingRequest->getAdopting() === $this) {
                $adoptingRequest->setAdopting(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdoptingRequest[]
     */
    public function getAdoptingRequests(): Collection
    {
        return $this->adoptingRequests;
    }
}
