<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/{user}', name: 'profile_index', methods: ['GET'], defaults: ["user" => null])]
    public function index(User $user = null, Security $security): Response
    {
        /** @var User */
        $user = $user ?: $security->getUser();
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'lastSessions' => $user->getLastSessions(2)
        ]);
    }
}
