<?php

namespace App\Controller;

use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class     HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(AdvertRepository $advertRepository, AdvertiserRepository $advertiserRepository)
    {
        $this->advertRepository = $advertRepository;
        $this->advertiserRepository = $advertiserRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(AdvertRepository $advertRepository, EntityManagerInterface $entityManager): Response
    {

        // appel repo function 5 last adverts
        //need entity manager
        $adverts = $this->advertRepository->callFiveAdverts();
        $advertisers = $this->advertiserRepository->findAll();

        return $this->render('home/index.html.twig', [
            'advertsHome' => $adverts,
            'advertisers' => $advertisers,
            'controller_name' => 'HomeController',
        ]);
    }
}
