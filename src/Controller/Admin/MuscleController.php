<?php

namespace App\Controller\Admin;

use App\Entity\Muscle;
use App\Form\MuscleType;
use App\Repository\MuscleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/muscle')]
class MuscleController extends AbstractController
{
    #[Route('/', name: 'muscle_index', methods: ['GET'])]
    public function index(MuscleRepository $muscleRepository): Response
    {
        return $this->render('admin/muscle/index.html.twig', [
            'muscles' => $muscleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'muscle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MuscleRepository $muscleRepository): Response
    {
        $muscle = new Muscle();
        $form = $this->createForm(MuscleType::class, $muscle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $muscleRepository->save($muscle, true);

            return $this->redirectToRoute('muscle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/muscle/new.html.twig', [
            'muscle' => $muscle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'muscle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Muscle $muscle, MuscleRepository $muscleRepository): Response
    {
        $form = $this->createForm(MuscleType::class, $muscle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $muscleRepository->save($muscle, true);

            return $this->redirectToRoute('muscle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/muscle/edit.html.twig', [
            'muscle' => $muscle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'muscle_delete', methods: ['POST'])]
    public function delete(Request $request, Muscle $muscle, MuscleRepository $muscleRepository): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$muscle->getId(), $request->request->get('_token'))) {
            $muscleRepository->remove($muscle, true);
        }

        return $this->redirectToRoute('muscle_index', [], Response::HTTP_SEE_OTHER);
    }
}
