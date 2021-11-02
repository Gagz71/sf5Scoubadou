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
     * @ORM\ManyToOne(targetEntity=Adopting::class, inversedBy="adoptingRequest")
     */
    private $adopting;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Advert::class, mappedBy="adoptingRequest")
     */
    private $advert;

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
        $this->advert = new ArrayCollection();
        $this->dogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getAdopting(): ArrayCollection
    {
        return $this->adopting;
    }

    /**
     * @param ArrayCollection $adopting
     */
    public function setAdopting(ArrayCollection $adopting): void
    {
        $this->adopting = $adopting;
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
     * @return ArrayCollection
     */
    public function getAdvert(): ArrayCollection
    {
        return $this->advert;
    }

    public function addAdvert(Advert $advert): self
    {
        if (!$this->advert->contains($advert)) {
            $this->advert[] = $advert;
            $advert->setAdoptingRequest($this);
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        if ($this->advert->removeElement($advert)) {
            // set the owning side to null (unless already changed)
            if ($advert->getAdoptingRequest() === $this) {
                $advert->setAdoptingRequest(null);
            }
        }

        return $this;
    }

    /**
     * @param ArrayCollection $advert
     */
    public function setAdvert(ArrayCollection $advert): void
    {
        $this->advert = $advert;
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
