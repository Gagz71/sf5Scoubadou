<?php

namespace App\Entity;

use App\Repository\UrlPictureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UrlPictureRepository::class)
 */
class UrlPicture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Dog::class, inversedBy="urlPictures")
     */
    private $dogs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDogs(): ?Dog
    {
        return $this->dogs;
    }

    public function setDogs(?Dog $dogs): self
    {
        $this->dogs = $dogs;

        return $this;
    }
}
