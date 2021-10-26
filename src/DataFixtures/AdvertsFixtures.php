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
			for ($i = 0; $i < 10; $i++) {
				$advert = new Advert();
				$advert->setTitle($title.$i);
				$advert->setStatus(random_int(0,1));
				$advert->setCreationDate(new \DateTime());
				$advert->setAdvertiser($advertisers[0]);
				
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