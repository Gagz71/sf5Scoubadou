<?php

namespace App\Controller;

use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  HomeController extends AbstractController
{
    public function __construct(AdvertRepository $advertRepository, AdvertiserRepository $advertiserRepository)
    {
        $this->advertRepository = $advertRepository;
        $this->advertiserRepository = $advertiserRepository;
    }

    /**
     * @Route("/", name="home")
     *
     */
    public function index(): Response
    {
        $adverts = $this->advertRepository->callFiveAdverts();
        $advertisers = $this->advertiserRepository->getAdvertsByDate();

        return $this->render('home/index.html.twig', [
            'advertsHome' => $adverts,
            'advertisers' => $advertisers,
            'controller_name' => 'HomeController',
        ]);
    }
}
