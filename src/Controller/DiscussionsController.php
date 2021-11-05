<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Entity\AdoptingRequest;
use App\Entity\Advert;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscussionsController extends AbstractController
{
    /**
     * @Route("/discussions/{id}", name="discussions")
     */
    public function showDiscussions(Adopting $adopting): Response
    {
        $listAdoptingRequest = $adopting->getAdoptingRequests();

        return $this->render('discussions/index.html.twig', [

            'listAdoptingRequest' => $listAdoptingRequest

        ]);
    }
}
