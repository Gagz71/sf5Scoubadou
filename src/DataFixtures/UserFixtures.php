<?php
	
	namespace App\DataFixtures;
	
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
					$user = new User();
					$user->setFirstName($firstname);
					$user->setLastName($lastname);
					$user->setEmail($firstname.'.'.$lastname.'@'.$lastname.'.com');
					$user->setPassword($firstname.'12345');
					$user->setRegisterDate(new \DateTime());
					
					$manager->persist($user);
					
				}
				
				$manager->flush();
			}
		}
	}