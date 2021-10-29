<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Advertiser;
use App\Entity\Dog;
use App\Form\AdvertType;
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

	    $adverts = $this->entityManager->getRepository(Advert::class)->findAll();
	    //var_dump($adverts.dogs);
        return $this->render('advert/index.html.twig', [
            'adverts' =>$adverts,
        ]);
    }
	
	/**
	 * @Route("/annonce/ajout", name="add-advert")
	 */
	public function addAdvert(Request $request): Response
	{
		$idUser = getUser()->getId();
		$advertiserId = $this->entityManager->getRepository(Advertiser::class)->findOneById($idUser);
		
		if (!$advertiserId){
			return $this->redirectToRoute('adverts');
		}
		
		$advert = new Advert();
		
		$dog = new Dog();
		$dog->setName('Rex');
		$advert->addDog($dog);
		
		$form = $this->createForm(AdvertType::class, $advert);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$advert->setCreationDate(new \DateTime());
			$advert->setStatus(0);
			$advertiser = $this->getUser();
			$advert->setAdvertiser($advertiser);
			// On enregistre
			$this->entityManager->persist($advert);
			$this->entityManager->flush();
			
			// On peut également afficher un message à l'utilisateur
			// Les flashs sont affichés une fois, au chargement de la page suivante
			// Et permettent donc d'afficher un message, malgré une redirection
			$this->addFlash('success', 'Nouvelle annonce ajoutée ');
			
			// Une fois que le formulaire est validé,
			// on redirige pour éviter que l'utilisateur ne recharge la page
			// et soumette la même information une seconde fois
			return $this->redirectToRoute('adverts');
		}
		
		
		return $this->render('advert/add-advert.html.twig', [
			'form' =>$form->createView(),
		]);
	}
	
	/**
	 * @Route("/annonce/{slug}", name="advert")
	 */
    public function singleAdvert($slug): Response
    {
	    $advert = $this->entityManager->getRepository(Advert::class)->findOneBySlug($slug);
	
	    if(!$advert){
		    return $this->redirectToRoute('adverts');
	    }
	
	    return $this->render('advert/single-advert.html.twig', [
		    'advert' => $advert,
	    ]);
    }
}