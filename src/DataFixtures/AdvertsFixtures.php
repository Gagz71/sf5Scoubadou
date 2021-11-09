<?php

namespace App\DataFixtures;

    use App\Entity\Advert;
    use App\Repository\AdvertiserRepository;
    use App\Repository\DogRepository;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Persistence\ObjectManager;

    class AdvertsFixtures extends Fixture implements DependentFixtureInterface
    {
        private AdvertiserRepository $advertiserRepository;
        private DogRepository $dogRepository;

        public function __construct(AdvertiserRepository $advertiserRepository, DogRepository $dogRepository)
        {
            $this->advertiserRepository = $advertiserRepository;
            $this->dogRepository = $dogRepository;
        }

        /**
         * {@inheritDoc}
         *
         * @throws \Exception
         */
        public function load(ObjectManager $manager)
        {
            $advertisers = $this->advertiserRepository->findAll();
            $dogs = $this->dogRepository->findAll();

            $title = 'Annonce d\'adoption n° ';
            $advertsUrlPicture = [
                'https://bit.ly/3jDzk7X',
                'https://bit.ly/3pVKitB',
                'https://bit.ly/3GuqiEe',
                'https://www.letribunaldunet.fr/wp-content/uploads/2018/05/bb.jpg',
                'https://www.letribunaldunet.fr/wp-content/uploads/2018/05/u.jpg',
                'https://www.letribunaldunet.fr/wp-content/uploads/2018/05/cc.jpg',
                'https://bit.ly/2ZyqrWn',
                'https://bit.ly/3EnYxei',
            ];

            for ($i = 0; $i < 10; ++$i) {
                $advertisersRandomIndex = shuffle($advertisers);
                $advertsUrlRandomIndex = shuffle($advertsUrlPicture);

                $advert = new Advert();
                $advert->setTitle($title.$i);
                $advert->setDogsNb(2);
                $advert->setStatus(true);
                $advert->setCreationDate(new \DateTime());
                $advert->setUrlPicture($advertsUrlPicture[$advertsUrlRandomIndex]);
                $advert->setAdvertiser($advertisers[$advertisersRandomIndex]);

                //T'en prends un et tu le sors du tableau
                $advert->addDog(array_pop($dogs));
                $advert->addDog(array_pop($dogs));

                $advert->setDescription('Mais Bohort, j\'vais vous faire mettre au cachot [...]. Non mais j\'vous écoute, j\'vous écoute seulement j\'vous préviens, j\'vous l\'dis, j\'vais vous faire descendre en cabane avec un pichet de flotte et un bout de pain sec. J\'suis désolé, j\'suis démuni, j\'vois pas d\'autre solution. Et puis j\'pense que ça vous donnera un peu l\'occasion de... de réfléchir un peu à tout ça à tête reposée, de prendre un peu d\'recul sur les choses parce que Bohort, on n\'réveille pas son roi en pleine nuit pour des conneries, encore moins deux fois d\'suite...');

                $manager->persist($advert);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                DogsFixtures::class,
                //Pour pouvoir utiliser l'AdvertFixtures, on doit dabord appeler AdvertiserFixtures
                AdvertiserFixtures::class,
            ];
        }
    }
