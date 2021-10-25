<?php

namespace App\Entity;

use App\Repository\AdvertiserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Advert::class, mappedBy="advertiser", orphanRemoval=true)
     */
    private $adverts;

    public function __construct()
    {
        $this->adverts = new ArrayCollection();
    }



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

    /**
     * @return Collection|Advert[]
     */
    public function getAdverts(): Collection
    {
        return $this->adverts;
    }

    public function addAdvert(Advert $advert): self
    {
        if (!$this->adverts->contains($advert)) {
            $this->adverts[] = $advert;
            $advert->setAdvertiser($this);
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        if ($this->adverts->removeElement($advert)) {
            // set the owning side to null (unless already changed)
            if ($advert->getAdvertiser() === $this) {
                $advert->setAdvertiser(null);
            }
        }

        return $this;
    }
}
