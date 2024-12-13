<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Univers;
use App\Repository\UniversRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/univers', name: 'univers_')]
class UniversController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UniversRepository $universRepository): Response
    {
        $universList = $universRepository->findAll();

        return $this->render('univers/index.html.twig', [
            'univers_list' => $universList,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function showOneUnivers(#[MapEntity(message: 'Cet univers de jeu n\'existe pas')] Univers $univers): Response
    {
        return $this->render('univers/show.html.twig', ['univers' => $univers]);
    }
}
