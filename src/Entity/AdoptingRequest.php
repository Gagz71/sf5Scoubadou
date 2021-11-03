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
     * @ORM\OneToMany(targetEntity=Discussion::class, mappedBy="adoptingRequest", cascade={"persist"})
     */
    private $discussions;

    public function __construct()
    {
        $this->dogs = new ArrayCollection();
        $this->discussions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Adopting
     */
    public function getAdopting(): Adopting
    {
        return $this->adopting;
    }

    /**
     * @param Adopting $adopting
     * @return AdoptingRequest
     */
    public function setAdopting(Adopting $adopting): self
    {
        $this->adopting = $adopting;

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
     * @return Advert
     */
    public function getAdvert(): Advert
    {
        return $this->advert;
    }

    /**
     * @param Advert $advert
     * @return AdoptingRequest
     */
    public function setAdvert(Advert $advert): self
    {
        $this->advert = $advert;

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

    /**
     * @return Collection|Discussion[]
     */
    public function getDiscussions(): Collection
    {
        return $this->discussions;
    }

    public function addDiscussion(Discussion $discussion): self
    {
        if (!$this->discussions->contains($discussion)) {
            $this->discussions[] = $discussion;
            $discussion->setAdoptingRequest($this);
        }

        return $this;
    }

    public function removeDiscussion(Discussion $discussion): self
    {
        if ($this->discussions->removeElement($discussion)) {
            // set the owning side to null (unless already changed)
            if ($discussion->getAdoptingRequest() === $this) {
                $discussion->setAdoptingRequest(null);
            }
        }

        return $this;
    }
}
