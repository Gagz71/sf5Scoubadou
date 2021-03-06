<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Advertiser;
use App\Entity\Dog;
use App\Entity\UrlPicture;
use App\Form\AdvertType;
use App\Repository\AdvertiserRepository;
use App\Repository\AdvertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/annonces", name="adverts")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $data = $this->getDoctrine()->getRepository(Advert::class)->findAll();

        $adverts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1), 6
        );

        return $this->render('advert/index.html.twig', [
            'adverts' => $adverts,
        ]);
    }

    /**
     * @Route("/annonce/{slug}/edit", name="edit-advert")
     * @Route("/annonce/ajout", name="add-advert")
     * @IsGranted("ROLE_ADVERTISER")
     */
    public function addAdvert(Request $request, ?Advert $advert = null): Response
    {
        /** @var Advertiser $advertiser */
        $advertiser = $this->getUser();

        if (is_null($advert)) {
            $advert = new Advert();

            $dog = new Dog();
            $dog->setName('Rex');
            $advert->addDog($dog);
            $picture = new UrlPicture();
            $dog->addUrlPicture($picture);
        }

        $form = $this->createForm(AdvertType::class, $advert);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advert->setCreationDate(new \DateTime());
            $advert->setStatus(false);
            $advert->setAdvertiser($advertiser);
            $this->entityManager->persist($advert);
            $this->entityManager->flush();
            $this->addFlash('success', 'Nouvelle annonce ajout??e ');

            return $this->redirectToRoute('adverts');
        }

        return $this->render('advert/add-advert.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/annonce/{slug}", name="advert")
     */
    public function singleAdvert(string $slug, AdvertRepository $advertRepository): Response
    {
        $advert = $advertRepository->findOneBy(['slug' => $slug]);

        if (is_null($advert)) {
            return $this->redirectToRoute('adverts');
        }

        return $this->render('advert/single-advert.html.twig', [
            'advert' => $advert,
        ]);
    }

    /**
     * @Route("/annonce/{slug}/supprimer", name="remove-advert")
     */
    public function removeAdvert(string $slug, AdvertRepository $advertRepository): Response
    {
        $advert = $advertRepository->findOneBy(['slug' => $slug]);
        $dogs = $advert->getDogs();
        foreach ($dogs as $dog) {
            $advert->removeDog($dog);
        }

        $this->entityManager->remove($advert);
        $this->entityManager->flush();

        return $this->redirectToRoute('adverts');
    }

    /**
     * @Route("/annonces/{id}", name="advert-by-advertiser")
     */
    public function getAdvertsByAdvertiser(Advertiser $advertiser): Response
    {
        return $this->render('advert/advertsByAdvertiser.html.twig', [
            'advertiser' => $advertiser,
        ]);
    }
}
