<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AdvertiserController extends AbstractController
{


    /**
     * @Route("/annonces/{id}", name = "advertiser_view")
     */
    public function advertiserView($id) {

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