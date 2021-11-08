<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Entity\AdoptingRequest;
use App\Entity\Advert;
use App\Entity\Advertiser;
use App\Entity\Discussion;
use App\Entity\Dog;
use App\Entity\UrlPicture;
use App\Form\AdoptingRequestType;
use App\Form\AdvertType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdoptingRequestController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/adopting/request/{id}", name="adopting_request")
     */
    public function addAdoptingRequest(Request $request, Advert $advert): Response
    {
        /** @var Adopting $adopting */
        $adopting = $this->getUser();
        /*if (!$adopting instanceof Adopting){
            return $this->redirectToRoute('adverts');
        }*/

        $adoptingRequest = new AdoptingRequest();
        $adoptingRequest->setAdopting($adopting);
        $adoptingRequest->setAdvert($advert);

        $discussion = new Discussion();
        $discussion->setCreationDate(new \DateTime());

        $adoptingRequest->addDiscussion($discussion);
	   

        $form = $this->createForm(AdoptingRequestType::class, $adoptingRequest, [
            'advert' => $advert,

        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adoptingRequest->setStatus(0);
		  

            // dd($adoptingRequest);

            // On enregistre
            $this->entityManager->persist($adoptingRequest);
            $this->entityManager->flush();

            $this->addFlash('success', 'Nouvelle requete envoyée ');

            return $this->redirectToRoute('discussions', ['id'=>$adoptingRequest->getId()]);
        }

        $listDiscussions = $adoptingRequest->getDiscussions();

        $advert = $adoptingRequest->getAdvert();


        return $this->render('adopting_request/view.html.twig', [
            'form' =>$form->createView(),
            'listDiscussions' => $listDiscussions

        ]);

    }

}
