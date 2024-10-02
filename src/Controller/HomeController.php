<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ScenarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ScenarioRepository $scenarioRepository): Response
    {
        $lastScenarios = $scenarioRepository->findBy([], ['createdAt' => 'DESC'], limit: 3);

        return $this->render('home/index.html.twig', [
            'last_scenarios' => $lastScenarios,
        ]);
    }
}
