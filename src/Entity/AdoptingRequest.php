<?php

namespace App\Entity;

use App\Repository\AdoptingRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdoptingRequestRepository::class)
 */
class AdoptingRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Adopting::class, mappedBy="adoptingRequest")
     */
    private $adopting;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Advertiser::class, mappedBy="adoptingRequest")
     */
    private $advertiser;

    public function __construct()
    {
        $this->adopting = new ArrayCollection();
        $this->advertiser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Adopting[]
     */
    public function getAdopting(): Collection
    {
        return $this->adopting;
    }

    public function addAdopting(Adopting $adopting): self
    {
        if (!$this->adopting->contains($adopting)) {
            $this->adopting[] = $adopting;
            $adopting->setAdoptingRequest($this);
        }

        return $this;
    }

    public function removeAdopting(Adopting $adopting): self
    {
        if ($this->adopting->removeElement($adopting)) {
            // set the owning side to null (unless already changed)
            if ($adopting->getAdoptingRequest() === $this) {
                $adopting->setAdoptingRequest(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Advertiser[]
     */
    public function getAdvertiser(): Collection
    {
        return $this->advertiser;
    }

    public function addAdvertiser(Advertiser $advertiser): self
    {
        if (!$this->advertiser->contains($advertiser)) {
            $this->advertiser[] = $advertiser;
            $advertiser->setAdoptingRequest($this);
        }

        return $this;
    }

    public function removeAdvertiser(Advertiser $advertiser): self
    {
        if ($this->advertiser->removeElement($advertiser)) {
            // set the owning side to null (unless already changed)
            if ($advertiser->getAdoptingRequest() === $this) {
                $advertiser->setAdoptingRequest(null);
            }
        }

        return $this;
    }
}
