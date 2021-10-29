<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Entity\User;
use App\Form\AdoptingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @Route("/register", name="register")
     * @Route ("/adopting/{id}/edit", name="adopting_edit")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, ?Adopting $adopting) : Response {

        {
            if(!$adopting) {
                $adopting = new Adopting();
            }
        }

        $form =$this->createForm(AdoptingType::class, $adopting);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$adopting->getId()) {
                $pwd = $this->hasher->hashPassword($adopting, $adopting->getPassword());
                $adopting->setPassword($pwd);
                $entityManager->persist($adopting);
            }
            $entityManager->flush();

            return $this->redirect($this->generateUrl('adopting_edit', ['id' => $adopting->getId()]));
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
