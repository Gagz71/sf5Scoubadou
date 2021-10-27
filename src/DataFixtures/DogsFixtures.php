<?php

namespace App\DataFixtures;

use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Dog;

class DogsFixtures extends Fixture implements DependentFixtureInterface
{
	private AdvertiserRepository  $advertiserRepository;
	private AdvertRepository $advertRepository;
	
	public function __construct(AdvertiserRepository $advertiserRepository, AdvertRepository $advertRepository){
		$this->advertiserRepository = $advertiserRepository;
		$this->advertRepository = $advertRepository;
	}
    public function load(ObjectManager $manager): void
    {
	    $races = $this->advertiserRepository->findAll();
	    $adverts = $this->advertRepository->findAll();
	    
	    $dogNames =[
		    'Snoopy',
		    'Sam',
		    'Ulysse',
		    'Romeo',
		    'Max',
		    'Stallone',
		    'Rex',
		    'Tyron',
		    'Prunelle',
		    'Rox',
		    'Pongo',
		    'Perdita',
		    'Pluto',
		    'Dingo',
		    'Snoop',
		    'Sloubi1',
		    'Sloubi2',
		    'Sloubi3',
		    'Sloubi4',
		    'Sloubi5'
	    ];
	    
	    $dogsUrlPicture=[
		    'https://bit.ly/2XKG9N8',
		    'https://bit.ly/3jDzk7X',
		    'https://i.imgur.com/J24C6krl.jpg',
		    'https://i.imgur.com/abuk4JTl.jpg',
		    'https://i.imgur.com/fDNmoWSl.jpg',
		    'https://bit.ly/3vKNPM9',
		    'https://bit.ly/2ZoVPGe'
	    ];
		
	    foreach ($dogNames as $dogName){
		    $dogsUrlRandomIndex = shuffle($dogsUrlPicture);
		    $advertsRandomIndex = shuffle($adverts);
		    $dog = new Dog();
		    $dog->setName($dogName);
		    $dog->setAntecedents('dogAntecedent');
		    $dog->setLof(random_int(0, 1));
		    $dog->setSociable(random_int(0, 1));
		    $dog->setIsAdopted(random_int(0, 1));
		    $dog->setAdvert($adverts[$advertsRandomIndex]);
		    $dog->setUrlPicture($dogsUrlPicture[$dogsUrlRandomIndex]);
		    
		    
		    $manager->persist($dog);
	    }
        $manager->flush();
    }
	
	public function getDependencies()
	{
		return[
			RaceFixtures::class,
			AdvertsFixtures::class,
		];
	}
}
