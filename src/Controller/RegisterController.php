<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Form\AdoptingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @Route("/account", name="account")
     */
    public function new(Request $request, EntityManagerInterface $entityManager) : Response {
        $adopting = new Adopting();

        $form =$this->createForm(AdoptingType::class, $adopting, [
            'method' => 'POST',
            'action' => $this->generateUrl('account'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() &&$form->isValid()) {
            $pwd = $this->hasher->hashPassword($adopting, $adopting->getPassword());
            $adopting->setPassword($pwd);
            $entityManager->persist($adopting);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }



}
