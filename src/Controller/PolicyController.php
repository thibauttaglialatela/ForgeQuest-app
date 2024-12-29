<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PolicyController extends AbstractController
{
    #[Route('/policy', name: 'app_policy')]
    public function index(): Response
    {
        return $this->render('policy/index.html.twig');
    }
}
