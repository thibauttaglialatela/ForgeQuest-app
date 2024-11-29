<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Scenario;
use App\Entity\Tag;
use App\Entity\Univers;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ScenarioFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du scénario',
                'constraints' => [
                    new NotBlank(message: 'N\'oublie pas le titre de ton scénario'),
                ]
            ])
            ->add('resume', CKEditorType::class, [
                'config' => ['toolbar' => 'full'],
                'label' => 'Le scénario',
                'sanitize_html' => true,
                'attr' => ['col' => 80, 'row' => 20],
                'constraints' => [
                    new NotBlank(message: 'Et le scénario ?'),
                ]

            ])
            ->add('imageFile')
            ->add('imageAlt')
            ->add('univers', EntityType::class, [
                'class' => Univers::class,
'choice_label'          => 'id',
                'label' => 'Univers',
            ])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
'choice_label'          => 'id',
'multiple'              => true,
                'label' => 'Tags'
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
