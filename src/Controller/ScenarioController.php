<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ScenarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/scenario', name: 'scenario_')]
class ScenarioController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ScenarioRepository $scenarioRepository): Response
    {
        $scenarios = $scenarioRepository->findAll();

        return $this->render('scenario/index.html.twig', [
            'scenarios' => $scenarios,
        ]);
    }
}
