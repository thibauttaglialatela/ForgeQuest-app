<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'required'    => false,
                'label'       => 'Votre pseudo',
                'attr'        => ['placeholder' => 'Aragorn64'],
                'constraints' => [
                    new Length(min: 2,
                        max: 50,
                        minMessage: 'Votre pseudo doit comporter au moins {{ limit }} lettres',
                        maxMessage: 'Votre pseudo ne peut pas comporter plus de {{ limit }} caractéres de long'
                    ),
                ],
            ])
            ->add('email', EmailType::class, [
                'label'           => 'E-mail',
                'attr'            => ['placeholder' => 'Aragorn64@exemple.fr'],
                'invalid_message' => 'Veuillez entrer une adresse e-mail valide',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped'      => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter notre politique de confidentialité.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'            => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'first_options'   => [
                    'label'                    => 'Mot de passe',
                    'hash_property_path'       => 'password',
                    'toggle'                   => true,
                    'hidden_label'             => 'Masquer',
                    'visible_label'            => 'Afficher',
                    'toggle_container_classes' => ['toggle-password-container'],
                    'button_classes'           => ['toggle-password-button'],
                ],
                'second_options' => [
                    'label'                    => 'Confirmation du mot de passe',
                    'hash_property_path'       => 'password',
                    'toggle'                   => true,
                    'hidden_label'             => 'Masquer',
                    'visible_label'            => 'Afficher',
                    'toggle_container_classes' => ['toggle-password-container'],
                    'button_classes'           => ['toggle-password-button'],
                ],
                'mapped' => false,
                'attr'   => ['autocomplete' => 'new-password'],
                'help'   => 'Pour être valide, votre mot de passe doit respecter les conditions suivantes :
                comporter au moins 12 lettres, une majuscule, un chiffre et un caractére spécial.',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min'        => 12,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractéres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{12,4096}$/",
                        'message' => 'Votre mot de passe doit comporter au minimum 12 lettres, une majuscule, un chiffre et un caractére spécial',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
