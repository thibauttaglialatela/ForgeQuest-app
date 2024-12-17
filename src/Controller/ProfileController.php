<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ScenarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(ScenarioRepository $scenarioRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $scenarioList = $scenarioRepository->findBy(['author' => $user]);

        return $this->render('profile/index.html.twig', [
            'scenario_list' => $scenarioList,
        ]);
    }
}
