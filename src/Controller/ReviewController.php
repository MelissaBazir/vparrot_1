<?php

namespace App\Controller;


use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    /**
     * This controller displays all the reviews (approved or not)
     *
     * @param ReviewRepository $repo
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/review', name: 'review.index', methods: ['GET'])]
    public function index(ReviewRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        //pagination
        $reviews = $paginator->paginate(
        $repo->findAll(), 
        $request->query->getInt('page', 1), /*page number*/
        9 /*limit per page*/
        );
        return $this->render('pages/review/index.html.twig', [
            'reviews' => $reviews
        ]);
    }

    /**
     * This controller is used to add a review
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/review/new', 'review.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager) : Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();

            $manager->persist($review);
            $manager->flush();

            // Message to inform the user review has been successfully sent
            $this->addFlash(
                'success',
                'Votre avis a bien été envoyé'
            );

        }
        
        return $this->render('pages/review/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/review/edition/{id}', 'review.edit', methods: ['GET', 'POST'])]
    public function edit(
        ReviewRepository $repo, 
        int $id, 
        Request $request, 
        EntityManagerInterface $manager): Response
    {
        $review = $repo->findOneBy(["id" => $id]);
        
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();

            $manager->persist($review);
            $manager->flush();

            // Message to inform the review has been successfully modified
            $this->addFlash(
                'success',
                'L\'avis a bien été modifié'
            );
        }
        
        return $this->render('pages/review/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}