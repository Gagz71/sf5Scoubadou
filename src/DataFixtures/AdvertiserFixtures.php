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
			
			$organizationNames = [
				'SPA',
				'Le coup de patte',
				'Ta main dans ma patte',
				'Boule de câlin ',
				'Boule d\'amour',
				'Le chien qui fait du bien',
				'Un kien vaut mieux que ???'
			];
			
			foreach($organizationNames  as  $organizationName){
				$bddOrganizationName = $slugger->slug($organizationName);
				
				$advertiser = new Advertiser();
				$advertiser->setOrganizationName($organizationName);
				$advertiser->setFirstname('');
				$advertiser->setLastname('');
				$advertiser->setOrganizationName($organizationName);
				$advertiser->setEmail('email@'.$bddOrganizationName.'.com');
				$advertiser->setPassword('');
				$advertiser->setRegisterDate(new \DateTime());
				$manager->persist($advertiser);
			}
			
			$manager->flush();
		}
		
	}