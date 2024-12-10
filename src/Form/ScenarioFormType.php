<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Scenario;
use App\Entity\Tag;
use App\Entity\Univers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ScenarioFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'       => 'Titre du scénario',
                'constraints' => [
                    new NotBlank(message: 'N\'oublie pas le titre de ton scénario'),
                ],
            ])
            ->add('resume', TextareaType::class, [
                'attr'        => ['cols' => 50, 'rows' => 10],
                'label'       => 'Le scénario',
                'constraints' => [
                    new NotBlank(message: 'Et le scénario ?'),
                ],
            ])
            ->add('imageFile', VichFileType::class, [
                'label'          => 'Image pour illustrer',
                'required'       => false,
                'allow_delete'   => true,
                'download_label' => 'image',
                'asset_helper'   => true,
                'delete_label'   => 'supprimer',
            ])
            ->add('imageAlt', TextType::class, [
                'label'    => 'Texte alternatif',
                'help'     => 'Veuillez fournir une description de l\'image',
                'required' => false,
            ])
            ->add('univers', EntityType::class, [
                'class'        => Univers::class,
                'choice_label' => 'name',
                'label'        => 'Univers',
            ])
            ->add('tag', EntityType::class, [
                'class'        => Tag::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'label'        => 'Tags',
                'expanded'     => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Scenario::class,
        ]);
    }
}
