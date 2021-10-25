<?php

namespace App\Entity;

use App\Repository\AdoptingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdoptingRepository::class)
 */
class Adopting extends User
{
}
