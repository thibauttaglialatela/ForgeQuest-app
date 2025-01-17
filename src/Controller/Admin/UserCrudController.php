<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn (Action $action) => $action->setLabel('Ajouter un utilisateur'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')->onlyOnIndex();
        yield EmailField::new('email', 'Email');
        yield TextField::new('pseudo', 'Pseudo');
        yield TextField::new('password', 'Mot de passe')->onlyOnForms()->hideWhenUpdating();
        yield ArrayField::new('roles', 'Roles')->onlyOnIndex();
        yield BooleanField::new('isVerified', 'Utilisateur vérifié');
        yield CollectionField::new('scenarios')
            ->setEntryType(AssociationField::class)
            ->setFormTypeOption('choice_label', 'title')
            ->onlyOnDetail();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un utilisateur')
            ->setPageTitle('index', 'Tous les utilisateurs du site')
            ->setPageTitle('detail', 'Fiche d\'utilisateur')
            ->setPageTitle('edit', 'Modifier un utilisateur')
        ;
    }
}
