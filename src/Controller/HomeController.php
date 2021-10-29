<?php

namespace App\Controller;

use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function AdvertiserViewAction($id) {

        //recupération de l'annonceur correspondant à l'id $id
        $em = $this->getDoctrine()->getManager();
        $advertiser = $em->getRepository('Advertiser')->find($id);

        if( null === $advertiser) {
            throw new NotFoundHttpException("La commande d'id ".$id." n'existe pas.");
        }
        $listAdverts = $em->getRepository('Advert')->findBy(array('advertiser' => $advertiser));
        $listAdoptingRqs = $em->getRepository('AdoptingRequest')->findBy(array('advertiser' => $advertiser));

        return $this->render('advertiser/view.html.twig', [
            'advertiser' => $advertiser,
            'listAdverts' => $listAdverts,
            'listAdoptingRqs' => $listAdoptingRqs
        ]);

    }



}
