<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Advertiser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $pwd = $this->hasher->hashPassword($admin, '12345');
        $admin->setFirstName('admin');
        $admin->setLastName('admin');
        $admin->setEmail("admin@admin.com");
        $admin->setPassword($pwd);
        $admin->setRegisterDate(new \DateTime());

        $manager->persist($admin);

        $manager->flush();
    }
}