<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Univers;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UniversCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Univers::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn (Action $action) => $action->setLabel('Ajouter un univers'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')->onlyOnIndex();
        yield TextField::new('name', 'Nom');
        yield TextEditorField::new('description')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->onlyOnForms();
        yield TextField::new('description')->onlyOnDetail();
        yield ImageField::new('imageName', 'Illustration')
            ->setBasePath('/uploads/univers')
            ->setUploadDir('public/uploads/univers')
            ->setUploadedFileNamePattern('[name]-[randomhash].[extension]');
        yield TextField::new('imageAlt', 'texte alternatif')->onlyOnForms();
        yield DateTimeField::new('createdAt')->onlyOnDetail();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setPageTitle('index', 'Liste des univers de jeu')
            ->setPageTitle('detail', 'Un univers')
            ->setPageTitle('edit', 'Modifier un univers')
        ;
    }
}
