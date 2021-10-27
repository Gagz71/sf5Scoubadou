<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\Admin;
	use App\Entity\Advertiser;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	use App\Entity\User;
	
	class UserFixtures extends Fixture
	{
		
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{
			$lastNames=[
				'Manhs',
				'Adj',
				'Baz',
				'De Galles',
				'De Vannes',
				'Pandragon',
				'Ackermann',
				'Benz',
				'Forson',
				'Lawson'
			];
			$firstNames = [
				'Douns',
				'Steph',
				'Evan',
				'Perceval',
				'Karadoc',
				'Arthur',
				'Mikasa',
				'Martha',
				'Jim',
				'Dawson'
			];
			
			foreach($lastNames as $lastname ){
				foreach($firstNames as $firstname){
					$user = new Advertiser();
					$user->setFirstName($firstname);
					$user->setLastName($lastname);
					$user->setEmail($firstname.'.'.$lastname.'@'.$lastname.'.com');
					$user->setPassword($firstname.'12345');
					$user->setRegisterDate(new \DateTime());
					$user->setOrganizationName('SPA');
					
					$manager->persist($user);
					
				}
				
			}
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