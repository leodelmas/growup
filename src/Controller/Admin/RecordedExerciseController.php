<?php

namespace App\Controller\Admin;

use App\Entity\RecordedExercise;
use App\Form\RecordedExerciseType;
use App\Repository\RecordedExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/recorded-exercise')]
class RecordedExerciseController extends AbstractController
{
    #[Route('/', name: 'recorded_exercise_index', methods: ['GET'])]
    public function index(RecordedExerciseRepository $recordedExerciseRepository): Response
    {
        return $this->render('admin/recorded_exercise/index.html.twig', [
            'recorded_exercises' => $recordedExerciseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'recorded_exercise_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $recordedExercise = new RecordedExercise();
        $form = $this->createForm(RecordedExerciseType::class, $recordedExercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recordedExercise);
            $entityManager->flush();

            return $this->redirectToRoute('recorded_exercise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/recorded_exercise/new.html.twig', [
            'recorded_exercise' => $recordedExercise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'recorded_exercise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RecordedExercise $recordedExercise): Response
    {
        $form = $this->createForm(RecordedExerciseType::class, $recordedExercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recorded_exercise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/recorded_exercise/edit.html.twig', [
            'recorded_exercise' => $recordedExercise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'recorded_exercise_delete', methods: ['POST'])]
    public function delete(Request $request, RecordedExercise $recordedExercise): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete' . $recordedExercise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recordedExercise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recorded_exercise_index', [], Response::HTTP_SEE_OTHER);
    }
}
