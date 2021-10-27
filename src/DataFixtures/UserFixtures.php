<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\Admin;
	use App\Entity\Advertiser;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	use App\Entity\User;
	use Symfony\Component\String\Slugger\AsciiSlugger;
	
	class UserFixtures extends Fixture
	{
		
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{
			$admin = new Admin();
			$admin->setFirstName('admin');
			$admin->setLastName('admin');
			$admin->setEmail("admin@admin.com");
			$admin->setPassword('12345');
			$admin->setRegisterDate(new \DateTime());
			
			$manager->persist($admin);
			
			$manager->flush();
		}
	}