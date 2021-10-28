<?php

namespace App\DataFixtures;

use App\Entity\Race;
use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use App\Repository\RaceRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Dog;

class DogsFixtures extends Fixture implements DependentFixtureInterface
{
	private AdvertiserRepository  $advertiserRepository;
	private AdvertRepository $advertRepository;
	private RaceRepository  $raceRepository;
	
	public function __construct(AdvertiserRepository $advertiserRepository, AdvertRepository $advertRepository, RaceRepository $raceRepository){
		$this->advertiserRepository = $advertiserRepository;
		$this->advertRepository = $advertRepository;
		$this->raceRepository = $raceRepository;
	}
    public function load(ObjectManager $manager): void
    {
	    $races = $this->advertiserRepository->findAll();
	    $adverts = $this->advertRepository->findAll();
	    $dogsRaces = $this->raceRepository->findAll();
	    
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
		    'http://4everstatic.com/images/850xX/animaux/chiens/mignon-chiot-176971.jpg',
		    'https://animalblog.co/files/2016-03/husky-1.jpg?7cf0f98d6d',
		    'https://www.letribunaldunet.fr/wp-content/uploads/2018/05/aa.jpg',
		    'https://static.wamiz.com/uploads/chiot%20mignon.jpg',
		    'https://bit.ly/3vKNPM9',
		    'https://bit.ly/2ZoVPGe'
	    ];
		
	    foreach ($dogNames as $dogName){
		    $dogsUrlRandomIndex = shuffle($dogsUrlPicture);
		    $advertsRandomIndex = shuffle($adverts);
		    $racesDogRandomIndex = shuffle($dogsRaces);
		    $dog = new Dog();
		    $dog->setName($dogName);
		    $dog->setAntecedents('dogAntecedent');
		    $dog->setLof(random_int(0, 1));
		    $dog->setSociable(random_int(0, 1));
		    $dog->setIsAdopted(random_int(0, 1));
		    $dog->setAdvert($adverts[$advertsRandomIndex]);
		    $dog->setUrlPicture($dogsUrlPicture[$dogsUrlRandomIndex]);
		    $dog->addRace($dogsRaces[$racesDogRandomIndex]);
		    
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
