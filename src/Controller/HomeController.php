<?php

namespace App\Controller;

use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(AdvertRepository $advertRepository, AdvertiserRepository $advertiserRepository)
    {
        $this->advertRepository = $advertRepository;
        $this->advertiserRepository = $advertiserRepository;
    }

    /**
     * @Route("/", name="home")
     *
     */
    public function index(AdvertRepository $advertRepository, EntityManagerInterface $entityManager): Response
    {
        $adverts = $this->advertRepository->callFiveAdverts();
        //$advertisers = $this->advertiserRepository->getAdvertsByDate();

        return $this->render('home/index.html.twig', [
            'advertsHome' => $adverts,
            //'advertisers' => $advertisers,
            'controller_name' => 'HomeController',
        ]);
    }

    public function listAdvertisers(EntityManager $entityManager, PaginatorInterface $paginator, Request $request)
    {
        $dql = "SELECT a FROM AcmeMainBundle:Advertiser a";
        $query = $entityManager->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('home/index.html.twig', [
                'pagination' => $pagination
            ]
        );
    }

}
