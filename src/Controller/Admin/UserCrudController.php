<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
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

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')->onlyOnIndex();
        yield EmailField::new('email', 'Email');
        yield TextField::new('pseudo', 'Pseudo');
        yield ArrayField::new('roles', 'Roles')->onlyOnIndex();
        yield BooleanField::new('isVerified', 'Utilisateur vérifié');
        yield CollectionField::new('scenarios')
            ->setEntryType(AssociationField::class)
            ->setFormTypeOption('choice_label', 'title')
            ->onlyOnDetail();
    }
}
