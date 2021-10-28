<?php

namespace App\Controller;

use App\Entity\Advert;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertController extends AbstractController
{
	private  $entityManager;
	
	public function __construct(EntityManagerInterface $entityManager){
		$this->entityManager = $entityManager;
	}
	
	
	/**
     * @Route("/annonces", name="adverts")
     */
    public function index(Request $request): Response
    {
        $user = $this->getUser();

	    $adverts = $this->entityManager->getRepository(Advert::class)->findAll();
	    //var_dump($adverts.dogs);
        return $this->render('advert/index.html.twig', [
            'adverts' =>$adverts,
        ]);
    }
}
