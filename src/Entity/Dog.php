<?php

namespace App\Entity;

use App\Repository\DogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DogRepository::class)
 */
class Dog
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
    private ? int $id = null;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $antecedents;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	private $lof;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $fullDescription;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	private $sociable;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	private $isAdopted;
	
	/**
	 * @ORM\ManyToMany (targetEntity=AdoptingRequest::class, inversedBy="dogs")
	 */
	private $adoptingRequests;
	
	/**
	 * @ORM\ManyToOne(targetEntity=Advert::class, inversedBy="dogs", cascade={"persist", "remove"})
	 */
	private $advert;
	
	/**
	 * @ORM\ManyToMany(targetEntity=Race::class, mappedBy="dog")
	 */
	private $races;
	

    /**
     * @ORM\OneToMany(targetEntity=UrlPicture::class, mappedBy="dogs", cascade={"persist", "remove"})
     */
    private $urlPictures;

    public function __construct()
    {
        $this->races = new ArrayCollection();
        $this->urlPictures = new ArrayCollection();
        $this->adoptingRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAntecedents(): ?string
    {
        return $this->antecedents;
    }

    public function setAntecedents(string $antecedents): self
    {
        $this->antecedents = $antecedents;

        return $this;
    }

    public function getLof(): ?bool
    {
        return $this->lof;
    }

    public function setLof(bool $lof): self
    {
        $this->lof = $lof;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    public function getSociable(): ?bool
    {
        return $this->sociable;
    }

    public function setSociable(bool $sociable): self
    {
        $this->sociable = $sociable;

        return $this;
    }

    public function getIsAdopted(): ?bool
    {
        return $this->isAdopted;
    }

    public function setIsAdopted(bool $isAdopted): self
    {
        $this->isAdopted = $isAdopted;

        return $this;
    }

    /**
     * @return Collection|AdoptingRequest[]
     */
    public function getAdoptingRequests(): Collection
    {
        return $this->adoptingRequests;
    }

    public function addAdoptingRequest(AdoptingRequest $adoptingRequest): self
    {
        if (!$this->adoptingRequests->contains($adoptingRequest)) {
            $this->adoptingRequests[] = $adoptingRequest;
            $adoptingRequest->addDog($this);
        }

        return $this;
    }

    public function removeAdoptingRequest(AdoptingRequest $adoptingRequest): self
    {
        if ($this->adoptingRequests->removeElement($adoptingRequest)) {
            $adoptingRequest->removeDog($this);
        }

        return $this;
    }

    public function getAdvert(): ?Advert
    {
        return $this->advert;
    }

    public function setAdvert(?Advert $advert): self
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * @return Collection|Race[]
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
            $race->addDog($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->removeElement($race)) {
            $race->removeDog($this);
        }

        return $this;
    }


    /**
     * @return Collection|UrlPicture[]
     */
    public function getUrlPictures(): Collection
    {
        return $this->urlPictures;
    }

    public function addUrlPicture(UrlPicture $urlPicture): self
    {
        if (!$this->urlPictures->contains($urlPicture)) {
            $this->urlPictures[] = $urlPicture;
            $urlPicture->setDogs($this);
        }

        return $this;
    }

    public function removeUrlPicture(UrlPicture $urlPicture): self
    {
        if ($this->urlPictures->removeElement($urlPicture)) {
            // set the owning side to null (unless already changed)
            if ($urlPicture->getDogs() === $this) {
                $urlPicture->setDogs(null);
            }
        }

        return $this;
    }
}
