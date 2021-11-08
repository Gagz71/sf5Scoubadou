<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Advertiser;
use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $adverts = $this->advertRepository->callThreeLastAdverts();
        $threeLastAdverts = $this->advertRepository->callThreeLastAdverts();
        $twoNextAdverts = $this->advertRepository->callTwoNextAdverts();

        $advertisers = $this->advertiserRepository->getAdvertsByDate();

        $advertisers = $paginator->paginate(
            $advertisers,
            $request->query->getInt('page',1),10
        );
        return $this->render('home/index.html.twig', [
            'advertsHome' => $adverts,
            'threeLastAdverts' => $threeLastAdverts,
            'twoNextAdverts' => $twoNextAdverts,
            'advertisers' => $advertisers,
            'controller_name' => 'HomeController',
        ]);
    }


}
