<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationForm extends AbstractType
{
    private const FORM_CONTROL_CLASS = 'form-control';

    public function __construct(private TranslatorInterface $translator) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'IDS_EMAIL',
                'attr' => ['class' => self::FORM_CONTROL_CLASS],
                'constraints' => [
                    new NotBlank([
                        'message' => 'IDS_EMAIL_NOT_BLANK',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'IDS_AGREE_TERMS',
                'constraints' => [
                    new IsTrue([
                        'message' => 'IDS_AGREE_TERMS_PLEASE',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'label' => 'Password',
                'attr' => ['class' => self::FORM_CONTROL_CLASS],
                'constraints' => [
                    new NotBlank([
                        'message' => 'IDS_PASSWORD_NOT_BLANK',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => $this->translator->trans('IDS_PASSWORD_MIN_LENGTH', ['%min_length%' => 6]),
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => ['class' => 'form'],
        ]);
    }
}
