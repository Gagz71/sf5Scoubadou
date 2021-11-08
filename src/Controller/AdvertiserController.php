<?php

namespace App\Controller;

use App\Entity\Advertiser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdvertiserController extends AbstractController
{
    /**
     * @Route("/annonceur/{id}", name = "advertiser_view")
     */
    public function advertiserView(Advertiser $advertiser)
    {
        $listAdverts = $advertiser->getAdverts();
        //$listAdoptingRqs = $advertiser ->getAdoptingRequest();
        //$listDogs = $advertiser - getDogs();
        return $this->render('advertiser/view.html.twig', [
            'advertiser' => $advertiser,
            'listAdverts' => $listAdverts,
            //'listAdoptingRqs' => $listAdoptingRqs
        ]);
    }
}
