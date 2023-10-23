<?php

namespace App\Controller;

use App\Entity\Open;
use App\Form\OpenType;
use App\Repository\OpenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/open')]
class OpenController extends AbstractController
{
    #[Route('/', name: 'app_open_index', methods: ['GET'])]
    public function index(OpenRepository $openRepository): Response
    {
        return $this->render('open/index.html.twig', [
            'opens' => $openRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_open_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $open = new Open();
        $form = $this->createForm(OpenType::class, $open);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($open);
            $entityManager->flush();

            return $this->redirectToRoute('app_open_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('open/new.html.twig', [
            'open' => $open,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_open_show', methods: ['GET'])]
    public function show(Open $open): Response
    {
        return $this->render('open/show.html.twig', [
            'open' => $open,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_open_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Open $open, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OpenType::class, $open);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_open_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('open/edit.html.twig', [
            'open' => $open,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_open_delete', methods: ['POST'])]
    public function delete(Request $request, Open $open, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$open->getId(), $request->request->get('_token'))) {
            $entityManager->remove($open);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_open_index', [], Response::HTTP_SEE_OTHER);
    }
}
