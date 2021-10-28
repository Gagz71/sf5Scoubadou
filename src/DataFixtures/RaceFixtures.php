<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\Race;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	
	class RaceFixtures extends Fixture
	{
		
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{
			$raceNames = [
				'Berger Allemand',
				'Husky Sibérien',
				'Dobermann',
				'Labrador',
				'Shiba Inu',
				'Rottweiler',
				'American Pit Bull Terrier',
				'Saint-Bernard',
				'Dalmatien',
				'Dog Allemand',
				'American Staffordshire Terrier',
				'Caniche',
				'Chihuahua',
				'Bulldog',
				'Carlin',
				'Teckel',
				'Border collie',
				'Jack Russell',
				'Yorkshire Terrier',
				'Boxer',
				'Pékinois',
				'Lévrier Afghan',
				'Inconnue'
			];
			
			foreach($raceNames  as $raceName ){
				$race = new Race();
				$race->setName($raceName);
				
				$manager->persist($race);
			}
			$manager->flush();
		}
	}