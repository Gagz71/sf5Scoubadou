<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\UrlPicture;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	
	class DogsUrlPictures extends Fixture
	{
		
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{
			$dogsUrlPicture=[
				'https://bit.ly/2XKG9N8',
				'http://4everstatic.com/images/850xX/animaux/chiens/mignon-chiot-176971.jpg',
				'https://animalblog.co/files/2016-03/husky-1.jpg?7cf0f98d6d',
				'https://www.letribunaldunet.fr/wp-content/uploads/2018/05/aa.jpg',
				'https://static.wamiz.com/uploads/chiot%20mignon.jpg',
				'https://bit.ly/3vKNPM9',
				'https://bit.ly/2ZoVPGe'
			];
			
			foreach($dogsUrlPicture as $dogUrlPicture){
				for($i = 0; $i<15; $i++){
					$dogPicture = new UrlPicture();
					$dogPicture->setUrl($dogUrlPicture);
					$manager->persist($dogPicture);
				}
			}
			$manager->flush();
		}
	}