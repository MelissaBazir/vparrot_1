<?php

namespace App\Controller;

use App\Entity\CarOffer;
use App\Form\CarOfferType;
use App\Repository\CarOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/car/offer')]
class CarOfferController extends AbstractController
{
    #[Route('/', name: 'app_car_offer_index', methods: ['GET'])]
    public function index(CarOfferRepository $carOfferRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $car_offers = $paginator->paginate(
            $carOfferRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );
        
        return $this->render('car_offer/index.html.twig', [
            'car_offers' => $car_offers,
        ]);
    }

    #[Route('/new', name: 'app_car_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carOffer = new CarOffer();
        $form = $this->createForm(CarOfferType::class, $carOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carOffer);
            $entityManager->flush();

            return $this->redirectToRoute('app_car_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_offer/new.html.twig', [
            'car_offer' => $carOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_offer_show', methods: ['GET'])]
    public function show(CarOffer $carOffer): Response
    {
        return $this->render('car_offer/show.html.twig', [
            'car_offer' => $carOffer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_car_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CarOffer $carOffer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarOfferType::class, $carOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_car_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_offer/edit.html.twig', [
            'car_offer' => $carOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_offer_delete', methods: ['POST'])]
    public function delete(Request $request, CarOffer $carOffer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carOffer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_car_offer_index', [], Response::HTTP_SEE_OTHER);
    }
}