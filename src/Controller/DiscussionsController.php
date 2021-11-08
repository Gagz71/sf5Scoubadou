<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Entity\AdoptingRequest;
use App\Entity\Advert;
use App\Entity\Discussion;
use App\Entity\User;
use App\Form\DiscussionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscussionsController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/discussions/{id}", name="discussions")
     */
    public function addMessage(Request $request, AdoptingRequest $adoptingRequest ,Advert $advert)
        : Response
    {

        $discussion = new Discussion();
        $discussion->setCreationDate(new \DateTime());
        $adoptingRequest->addDiscussion($discussion);

        $form = $this->createForm(DiscussionType::class, $discussion, [

            ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($discussion);
            $this->entityManager->flush();

            $this->addFlash('success', 'Nouveau message envoyé');
            return $this->redirectToRoute('discussions', [
                'id' => $adoptingRequest->getId(),

            ]);


        }

        $listDiscussions = $adoptingRequest->getDiscussions();

        return $this->render('discussions/index.html.twig', [
            'form' =>$form->createView(),
            'listDiscussions' => $listDiscussions,
            'adoptingRequest' => $adoptingRequest,

        ]);
    }
}
