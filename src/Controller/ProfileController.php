<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'profile_index', methods: ['GET'])]
    public function index(Security $security, User $user = null): Response
    {
        /** @var User */
        $user = $security->getUser();
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'lastSessions' => $user->getLastSessions(2)
        ]);
    }

    #[Route('/edit', name: 'profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Security $security): Response
    {
        /** @var User */
        $user = $security->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
