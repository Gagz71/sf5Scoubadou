<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\Advertiser;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	use Symfony\Component\String\Slugger\AsciiSlugger;
	
	class AdvertiserFixtures extends Fixture
	{
		
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{
			
			$slugger = new AsciiSlugger('fr');
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
			$organizationNames = [
				'SPA',
				'Le coup de patte',
				'Ta main dans ma patte',
				'Boule de câlin ',
				'Boule d\'amour',
				'Le chien qui fait du bien',
				'Un kien vaut mieux que ???'
			];
			
			foreach($lastNames as $key0 => $lastname ){
				foreach($firstNames as $key => $firstname) {
					$advertiser = new Advertiser();
					
					$advertOrganizationRandIndex = shuffle($organizationNames);
					$advertiser->setFirstName($firstname);
					$advertiser->setLastName($lastname);
					
					$advertiser->setEmail('email@'.$organizationNames[$advertOrganizationRandIndex]. $key0.$key.'.com');
					$advertiser->setOrganizationName($organizationNames[$advertOrganizationRandIndex]);
					$advertiser->setPassword('1234');
					$advertiser->setRegisterDate(new \DateTime());
					
					$manager->persist($advertiser);
					
				}
				
			}
			
			$manager->flush();
		}
		
	}