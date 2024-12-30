<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

final class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment', TextareaType::class, [
                'label' => 'Commentaire',
                'attr'  => ['cols' => 50, 'rows' => 10],
            ])
            ->add('grade', IntegerType::class, [
                'label'           => 'Votre note',
                'help'            => 'Votre notre doit être comprise entre 1 et 5 compris',
                'invalid_message' => 'Votre note n\'est pas valide',
            ]);
    }
}
