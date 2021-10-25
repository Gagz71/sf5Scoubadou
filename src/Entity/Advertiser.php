<?php

namespace App\Entity;

use App\Repository\AdvertiserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @ORM\Entity(repositoryClass=AdvertiserRepository::class)
 * @Entity
 */
class Advertiser extends User
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organizationName;

    /**
     * @ORM\ManyToOne(targetEntity=AdoptingRequest::class, inversedBy="advertiser")
     */
    private $adoptingRequest;



    public function getOrganizationName(): ?string
    {
        return $this->organizationName;
    }

    public function setOrganizationName(string $organizationName): self
    {
        $this->organizationName = $organizationName;

        return $this;
    }

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
