<?php

namespace App\Entity;

use App\Repository\AdoptingRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Dog;

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

    /**
     * @ORM\ManyToMany (targetEntity=Dog::class, mappedBy="adoptingRequests")
     */
    private $dogs;

    /**
     * @ORM\OneToOne(targetEntity=Discussion::class, inversedBy="adoptingRequest", cascade={"persist", "remove"})
     */
    private $discussion;

    public function __construct()
    {
        $this->adopting = new ArrayCollection();
        $this->advertiser = new ArrayCollection();
        $this->dogs = new ArrayCollection();
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

    /**
     * @return Collection|Dog[]
     */
    public function getDogs(): Collection
    {
        return $this->dogs;
    }

    public function addDog(Dog $dog): self
    {
        if (!$this->dogs->contains($dog)) {
            $this->dogs[] = $dog;
        }

        return $this;
    }

    public function removeDog(Dog $dog): self
    {
        $this->dogs->removeElement($dog);

        return $this;
    }

    public function getDiscussion(): ?Discussion
    {
        return $this->discussion;
    }

    public function setDiscussion(?Discussion $discussion): self
    {
        $this->discussion = $discussion;

        return $this;
    }
}
