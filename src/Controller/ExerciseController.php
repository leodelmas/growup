<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Entity\Session;
use App\Form\ExerciseType;
use App\Repository\ExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exercise')]
class ExerciseController extends AbstractController
{
    #[Route('/{id}/edit', name: 'exercise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exercise $exercise): Response
    {
        $form = $this->createForm(ExerciseType::class, $exercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('session_edit', [
                'id' => $exercise->getSession()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/exercise/edit.html.twig', [
            'exercise' => $exercise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'exercise_delete', methods: ['POST'])]
    public function delete(Request $request, Exercise $exercise): Response
    {
        if ($this->isCsrfTokenValid('delete' . $exercise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exercise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('session_edit', [
            'id' => $exercise->getSession()->getId()
        ], Response::HTTP_SEE_OTHER);
    }
}
