<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Scenario;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ScenarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Scenario::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn (Action $action) => $action->setLabel('Ajouter un scénario'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        yield TextField::new('title');
        yield DateTimeField::new('createdAt');
        yield BooleanField::new('isPublished');
        yield TextEditorField::new('resume');
        yield ImageField::new('imageName', 'Illustration')
            ->setBasePath('uploads/scenarios')
            ->setUploadDir('public/uploads/scenarios')
            ->setUploadedFileNamePattern('[name]-[randomhash].[extension]');
        yield TextField::new('imageAlt')->onlyOnForms();
        yield AssociationField::new('univers');
        yield AssociationField::new('tag')
            ->setFormTypeOption('choice_label', 'name')
            ->setFormTypeOption('multiple', true)
            ->setFormTypeOption('expanded', true);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajouter un scénario')
            ->setPageTitle('index', 'Liste des scénarios')
            ->setPageTitle('detail', 'Un scénario')
            ->setPageTitle('edit', 'Modifier un scénario')
            ->renderContentMaximized()
        ;
    }
}
