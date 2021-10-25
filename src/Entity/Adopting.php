<?php

namespace App\Entity;

use App\Repository\AdoptingRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @ORM\Entity(repositoryClass=AdoptingRepository::class)
 * @Entity
 */
class Adopting extends User
{
}
