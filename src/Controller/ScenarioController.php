<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Scenario;
use App\Entity\User;
use App\Form\ScenarioFormType;
use App\Repository\ScenarioRepository;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/scenario', name: 'scenario_')]
class ScenarioController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ScenarioRepository $scenarioRepository): Response
    {
        $scenarios = $scenarioRepository->findBy(['isPublished' => true]);

        return $this->render('scenario/index.html.twig', [
            'scenarios' => $scenarios,
        ]);
    }

    #[IsGranted('ROLE_USER', statusCode: 403)]
    #[Route('/add', name: 'create')]
    public function addScenario(Request $request, EntityManagerInterface $entityManager, MailService $mailService): Response
    {
        $scenario = new Scenario();
        /** @var User $user */
        $user = $this->getUser();

        /** @var User|null $adminUser */
        $adminUser = $entityManager->getRepository(User::class)->findOneUserByRole('ROLE_ADMIN');

        $scenarioForm = $this->createForm(ScenarioFormType::class, $scenario);
        $scenarioForm->handleRequest($request);

        if ($scenarioForm->isSubmitted() && $scenarioForm->isValid()) {
            $scenario = $scenarioForm->getData();
            if ($scenario instanceof Scenario) {
                $scenario->setCreatedAt(new \DateTimeImmutable('now'));
                $scenario->setAuthor($user);
                $entityManager->persist($scenario);
                $entityManager->flush();

                if (null !== $adminUser) {
                    $adminUserEmail = $adminUser->getEmail();
                    if (null !== $adminUserEmail) {
                        $mailService->sendMail($adminUserEmail, 'Modération d\'un scénario', 'scenario/validation_scenario.html.twig');
                    }
                }

                $this->addFlash('success', 'Merci pour votre proposition de scénario. Celui-ci sera publié aprés modération de la part de l’administrateur du site.');

                return $this->redirectToRoute('scenario_index');
            }
        }

        return $this->render('scenario/add.html.twig', [
            'scenario_form' => $scenarioForm,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function showOneScenario(
        #[MapEntity(message: 'Le scénario n\'existe pas')]
        Scenario $scenario,
    ): Response {
        return $this->render('scenario/show.html.twig', ['scenario' => $scenario]);
    }
}
