<?php

namespace App\DataFixtures;

use App\Entity\Dog;
use App\Repository\AdvertRepository;
use App\Repository\RaceRepository;
use App\Repository\UrlPictureRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DogsFixtures extends Fixture implements DependentFixtureInterface
{
    private AdvertRepository $advertRepository;
    private RaceRepository  $raceRepository;
    private UrlPictureRepository  $urlPictureRepository;

    public function __construct(AdvertRepository $advertRepository, RaceRepository $raceRepository, UrlPictureRepository $urlPictureRepository)
    {
        $this->advertRepository = $advertRepository;
        $this->raceRepository = $raceRepository;
        $this->urlPictureRepository = $urlPictureRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $adverts = $this->advertRepository->findAll();
        $dogsRaces = $this->raceRepository->findAll();
        $dogsUrlPicture = $this->urlPictureRepository->findAll();

        $dogNames = [
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
            'Sloubi5',
        ];

        foreach ($dogNames as $dogName) {
            $advertsRandomIndex = shuffle($adverts);
            $racesDogRandomIndex = shuffle($dogsRaces);
            $dog = new Dog();
            $dog->setName($dogName);
            $dog->setAntecedents('dogAntecedent');
            $dog->setFullDescription('Coucou, moi c\'est '.$dogName.' ! Je fais environ 15 kgs.Ma tatie dit que je suis le loulou parfait !J\'aime beaucoup jouer, je suis encore jeune et
				 j\'ai de l\'énergie à revendre 🤪 Je m\'entend bien avec tous les copains, chats 🐈 ou chiens 🐕\nJ\'adoooooore ça !! Du coup faudra prévoir des moments câlins et gratouilles car ça sera primordial pour mon bien être, oui oui 😌
				Troisièmement, et c\'est ce point là qui va vous convaincre j\'en suis sûr... Je suis très intelligent 🤓 Je comprend vite ce qu\'on me demande ! Je sais même donner la patte, c\'est pas trop cool ça ? 😎 Je reviens aussi quand on m\'appelle et je marche bien en laisse!\n Alors vous êtes tombé sous mon charme ? Attendez j\'ai encore pleins de qualités à vous révéler... mais pour ça, faudra m\'adopter !🥰',
            );
            $dog->setLof(random_int(0, 1));
            $dog->setSociable(random_int(0, 1));
            $dog->setIsAdopted(0);
            //		    $dog->setAdvert($adverts[$advertsRandomIndex]);
            $dog->addRace($dogsRaces[$racesDogRandomIndex]);
            for ($i = 0; $i < 5; ++$i) {
                $dogsUrlRandomIndex = shuffle($dogsUrlPicture);
                $dog->addUrlPicture($dogsUrlPicture[$dogsUrlRandomIndex]);
            }

            $manager->persist($dog);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DogsUrlPictures::class,
            RaceFixtures::class,
//			AdvertsFixtures::class,
        ];
    }
}
