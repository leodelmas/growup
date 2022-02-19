<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Entity\Session;
use App\Form\ExerciseType;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/session')]
class SessionController extends AbstractController
{
    #[Route('/', name: 'session_index', methods: ['GET'])]
    public function index(SessionRepository $sessionRepository, Security $security): Response
    {
        return $this->render('session/index.html.twig', [
            'sessions' => $sessionRepository->findBy(['user' => $security->getUser()]),
        ]);
    }

    #[Route('/all', name: 'session_all', methods: ['GET'])]
    public function all(SessionRepository $sessionRepository, Security $security): Response
    {
        return $this->render('session/all.html.twig', [
            'sessions' => $sessionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'session_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Security $security): Response
    {
        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->setUser($security->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('session_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/new.html.twig', [
            'session' => $session,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'session_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Session $session): Response
    {
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('session_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/edit.html.twig', [
            'session' => $session,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'session_delete', methods: ['POST'])]
    public function delete(Request $request, Session $session): Response
    {
        if ($this->isCsrfTokenValid('delete' . $session->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($session);
            $entityManager->flush();
        }

        return $this->redirectToRoute('session_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/exercice/new', name: 'exercise_new', methods: ['GET', 'POST'])]
    public function newExercice(Request $request, Session $session): Response
    {
        $exercise = new Exercise();
        $exercise->setSession($session);
        $form = $this->createForm(ExerciseType::class, $exercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exercise);
            $entityManager->flush();

            return $this->redirectToRoute('session_edit', [
                'id' => $session->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/exercise/new.html.twig', [
            'session' => $session,
            'exercise' => $exercise,
            'form' => $form,
        ]);
    }
}
