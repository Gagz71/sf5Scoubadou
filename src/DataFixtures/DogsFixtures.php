<?php

namespace App\DataFixtures;

use App\Entity\Race;
use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use App\Repository\RaceRepository;
use App\Repository\UrlPictureRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Dog;

class DogsFixtures extends Fixture implements DependentFixtureInterface
{
	private AdvertiserRepository  $advertiserRepository;
	private AdvertRepository $advertRepository;
	private RaceRepository  $raceRepository;
	private UrlPictureRepository  $urlPictureRepository;
	
	public function __construct(AdvertiserRepository $advertiserRepository, AdvertRepository $advertRepository, RaceRepository $raceRepository, UrlPictureRepository $urlPictureRepository ){
		$this->advertiserRepository = $advertiserRepository;
		$this->advertRepository = $advertRepository;
		$this->raceRepository = $raceRepository;
		$this->urlPictureRepository = $urlPictureRepository;
	}
    public function load(ObjectManager $manager): void
    {
	    $adverts = $this->advertRepository->findAll();
	    $dogsRaces = $this->raceRepository->findAll();
	    $dogsUrlPicture = $this->urlPictureRepository->findAll();
	    
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
	    
		
	    foreach ($dogNames as $dogName){
		    
		    $advertsRandomIndex = shuffle($adverts);
		    $racesDogRandomIndex = shuffle($dogsRaces);
		    $dog = new Dog();
		    $dog->setName($dogName);
		    $dog->setAntecedents('dogAntecedent');
		    $dog->setLof(random_int(0, 1));
		    $dog->setSociable(random_int(0, 1));
		    $dog->setIsAdopted(random_int(0, 1));
		    $dog->setAdvert($adverts[$advertsRandomIndex]);
		    $dog->addRace($dogsRaces[$racesDogRandomIndex]);
		    for ($i = 0; $i < 5; $i++){
			    $dogsUrlRandomIndex = shuffle($dogsUrlPicture);
			    $dog->addUrlPicture($dogsUrlPicture[$dogsUrlRandomIndex]);
		    }
		    
		    $manager->persist($dog);
	    }
        $manager->flush();
    }
	
	public function getDependencies()
	{
		return[
			DogsUrlPictures::class,
			RaceFixtures::class,
			AdvertsFixtures::class,
		];
	}
}
