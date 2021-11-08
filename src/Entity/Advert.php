<?php

namespace App\Entity;

use App\Repository\AdvertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=AdvertRepository::class)
 */
class Advert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dogsNb;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updateDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Dog::class, mappedBy="advert", cascade={"persist", "remove"})
     */
    private $dogs;

    /**
     * @ORM\ManyToOne(targetEntity=Advertiser::class, inversedBy="adverts", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Advertiser $advertiser;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlPicture;

    /**
     * @ORM\OneToMany(targetEntity=AdoptingRequest::class, mappedBy="advert")
     */
    private Collection $adoptingRequests;

    public function __construct()
    {
        $this->dogs = new ArrayCollection();
        $this->adoptingRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDogsNb(): ?int
    {
        return $this->dogsNb;
    }

    public function setDogsNb(int $dogsNb): self
    {
        $this->dogsNb = $dogsNb;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

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
            $dog->setAdvert($this);
        }

        return $this;
    }

    public function removeDog(Dog $dog): self
    {
        if ($this->dogs->removeElement($dog)) {
            // set the owning side to null (unless already changed)
            if ($dog->getAdvert() === $this) {
                $dog->setAdvert(null);
            }
        }

        return $this;
    }

    public function getAdvertiser(): ?Advertiser
    {
        return $this->advertiser;
    }

    public function setAdvertiser(?Advertiser $advertiser): self
    {
        $this->advertiser = $advertiser;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getUrlPicture()
    {
        return $this->urlPicture;
    }

    public function setUrlPicture($urlPicture): void
    {
        $this->urlPicture = $urlPicture;
    }

    public function getThreePictures()
    {
        $ret = [];
        foreach ($this->getDogs() as $dog) {
            foreach ($dog->getUrlPictures() as $picture) {
                $ret[] = $picture;
                if (count($ret) >= 3) {
                    return $ret;
                }
            }
        }

        return $ret;
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
            $adoptingRequest->setAdvert($this);
        }

        return $this;
    }

    public function removeAdoptingRequest(AdoptingRequest $adoptingRequest): self
    {
        if ($this->adoptingRequests->removeElement($adoptingRequest)) {
            // set the owning side to null (unless already changed)
            if ($adoptingRequest->getAdvert() === $this) {
                $adoptingRequest->setAdvert(null);
            }
        }

        return $this;
    }

    public function __sleep()
    {
        return [];
    }
}
