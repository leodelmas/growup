<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard_index', methods: ['GET'])]
    public function index(SessionRepository $sessionRepository, Security $security): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'sessions' => $sessionRepository->findBy(['user' => $security->getUser()]),
        ]);
    }
}
