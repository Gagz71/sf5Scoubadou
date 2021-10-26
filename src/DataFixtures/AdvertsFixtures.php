<?php
	
	namespace App\DataFixtures;
	
	use App\Repository\AdvertiserRepository;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\DataFixtures\DependentFixtureInterface;
	use Doctrine\Persistence\ObjectManager;
	use App\Entity\Advert;
	
	class AdvertsFixtures extends Fixture implements DependentFixtureInterface
	{
		private AdvertiserRepository $advertiserRepository;
		
		public function __construct(AdvertiserRepository $advertiserRepository)
		{
			$this->advertiserRepository = $advertiserRepository;
		}
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{
			$advertisers = $this->advertiserRepository->findAll();
			$title='Annonce d\'adoption n° ';
			/*$advertsUrlPicture = [
				''
			];*/
			for ($i = 0; $i < 10; $i++) {
				$advert = new Advert();
				$advert->setTitle($title.$i);
				$advert->setDogsNb(random_int(1, 15));
				$advert->setStatus(random_int(0,1));
				$advert->setCreationDate(new \DateTime());
				$advert->setUrlPicture('https://bit.ly/3jDzk7X');
				$advert->setAdvertiser($advertisers[0]);
				$advert->setDescription('Mais Bohort, j\'vais vous faire mettre au cachot [...]. Non mais j\'vous écoute, j\'vous écoute seulement j\'vous préviens, j\'vous l\'dis, j\'vais vous faire descendre en cabane avec un pichet de flotte et un bout de pain sec. J\'suis désolé, j\'suis démuni, j\'vois pas d\'autre solution. Et puis j\'pense que ça vous donnera un peu l\'occasion de... de réfléchir un peu à tout ça à tête reposée, de prendre un peu d\'recul sur les choses parce que Bohort, on n\'réveille pas son roi en pleine nuit pour des conneries, encore moins deux fois d\'suite...');
				
				$manager->persist($advert);
			}
			$manager->flush();
		}
		
		public function getDependencies()
		{
			return [
				//Pour pouvoir utiliser l'AdvertFixtures, on doit dabord appeler AdvertiserFixtures
				AdvertiserFixtures::class,
			];
		}
	}