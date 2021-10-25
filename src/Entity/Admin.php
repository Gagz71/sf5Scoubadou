<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * @Entity
 */
class Admin extends User
{

}
