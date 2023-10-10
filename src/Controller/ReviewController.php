<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    /**
     * This functions displays all the reviews (approved or not)
     *
     * @param ReviewRepository $repo
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/review', name: 'app_review', methods: ['GET'])]
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
}