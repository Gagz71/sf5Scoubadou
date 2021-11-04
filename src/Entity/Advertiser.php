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
     * @ORM\OneToMany(targetEntity=Advert::class, mappedBy="advertiser", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $adverts;

    public function __construct()
    {

        parent::__construct();

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

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = parent::getRoles();
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ADVERTISER';

        return array_unique($roles);
    }

    public function countAdvertsAvailable() {
        $cpt = 0;
        foreach ($this->getAdverts() as $advert) {
            if ($advert->getStatus()) {
                $cpt++;
            }
        }
        return $cpt;
    }

    public function countAdvertsNotAvailable() {
        $cpt = 0;
        foreach ($this->getAdverts() as $advert) {
            if (!$advert->getStatus()) {
                $cpt++;
            }
        }
        return $cpt;
    }

    public function countAdverts() {
        $cpt = 0;
        foreach ($this->getAdverts() as $advert) {
            $cpt++;
        }
        return $cpt;
    }
}
