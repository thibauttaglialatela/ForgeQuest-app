<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

final class ReviewCrudController extends AbstractCrudController
{
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW);
    }

    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')->onlyOnIndex();
        yield TextareaField::new('comment', 'Commentaire');
        yield NumberField::new('grade', 'Note');
        yield BooleanField::new('isPublished', 'Mis en ligne ?');
        yield AssociationField::new('author', 'Auteur');
        yield AssociationField::new('scenario', 'Scénario associé');
        yield DateTimeField::new('createdAt', 'Date de creation')->onlyOnIndex();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setPageTitle('index', 'Liste des commentaires')
            ->setPageTitle('detail', 'Un commentaire')
            ->setPageTitle('edit', 'Modifier un commentaire')
        ;
    }
}
