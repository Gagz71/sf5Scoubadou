<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\AST\OrderByItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $advertisers = $this->advertiserRepository->getAdvertsByDate();

        return $this->render('home/index.html.twig', [
            'advertsHome' => $adverts,
            'advertisers' => $advertisers,
            'controller_name' => 'HomeController',
        ]);
    }

}
