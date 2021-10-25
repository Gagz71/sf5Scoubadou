<?php

namespace App\Entity;

use App\Repository\DiscussionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiscussionRepository::class)
 */
class Discussion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="object")
     */
    private $adopting;

    /**
     * @ORM\Column(type="object")
     */
    private $advertiser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="object")
     */
    private $adooptionRequest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdopting()
    {
        return $this->adopting;
    }

    public function setAdopting($adopting): self
    {
        $this->adopting = $adopting;

        return $this;
    }

    public function getAdvertiser()
    {
        return $this->advertiser;
    }

    public function setAdvertiser($advertiser): self
    {
        $this->advertiser = $advertiser;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getAdooptionRequest()
    {
        return $this->adooptionRequest;
    }

    public function setAdooptionRequest($adooptionRequest): self
    {
        $this->adooptionRequest = $adooptionRequest;

        return $this;
    }
}