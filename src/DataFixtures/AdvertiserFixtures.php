<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\Advertiser;
	use App\Repository\AdvertRepository;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
	use Symfony\Component\String\Slugger\AsciiSlugger;
	
	class AdvertiserFixtures extends Fixture
	{
		private AdvertRepository $advertRepository;
		private UserPasswordHasherInterface $hasher;
		
		public function __construct(AdvertRepository $advertRepository, UserPasswordHasherInterface $hasher)
		{
			$this->advertRepository = $advertRepository;
			$this->hasher = $hasher;
		}
		
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{
		
			$adverts = $this->advertRepository->findAll();
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
					
					$advertRandomIndex = shuffle($adverts);
					
					$advertOrganizationRandIndex = shuffle($organizationNames);
					$advertiser->setFirstname($firstname);
					$advertiser->setLastname($lastname);
					
					$advertiser->setEmail('email@'.$organizationNames[$advertOrganizationRandIndex]. $key0.$key.'.com');
					$advertiser->setOrganizationName($organizationNames[$advertOrganizationRandIndex]);
					$pwd = $this->hasher->hashPassword($advertiser, '1234');
					$advertiser->setPassword($pwd);
					$advertiser->setRegisterDate(new \DateTime());
					
					$manager->persist($advertiser);
				}
			}
			$manager->flush();
		}
		
	}