<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Scenario;
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
}
