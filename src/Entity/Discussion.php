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
     * @ORM\Column(type="text")

    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;
    
    /**
     * @ORM\OneToOne(targetEntity=AdoptingRequest::class, inversedBy="discussions", cascade={"persist", "remove"})
     */
    private $adoptingRequest;

    public function getId(): ?int
    {
        return $this->id;
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
