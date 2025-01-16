<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Review;
use App\Entity\Scenario;
use App\Entity\Tag;
use App\Entity\Univers;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(ScenarioCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ForgeQuest Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::LinkToRoute('Accueil', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Scenarios', 'fas fa-book', Scenario::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-message', Review::class);
        yield MenuItem::linkToCrud('Univers', 'fas fa-dragon', Univers::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tag', Tag::class);
        yield MenuItem::LinkToUrl('Se déconnecter', 'fas fa-sign-out-alt', '/logout');
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
