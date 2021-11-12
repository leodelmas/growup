<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExerciseController extends AbstractController
{
    #[Route('/', name: 'dashboard_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }
}