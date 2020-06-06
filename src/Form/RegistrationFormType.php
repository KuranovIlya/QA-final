<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите Email.'
                    ])
                ],
                'attr' => [
                    'class' => 'input__text',
                    'placeholder' => 'Ваш Email'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Подтвердите, что вы согласны с нашими правилами.',
                    ]),
                ],
            ])
            ->add('fullname', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите ваше имя.'
                    ]),
                    new Regex([
                        'pattern' => '/^[А-Я][-А-я ]+$/u',
                        'message' => 'Имя может содержать только русские буквы, а также пробелы и дефисы'
                    ])
                ],
                'attr' => [
                    'class' => 'input__text',
                    'placeholder' => 'Введите ваше имя'
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'required' => true,
                'type' => PasswordType::class,
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ваш пароль должен содержать минимум {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                    new Regex([
                        'pattern' => '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/',
                        'message' => 'Пароль долежн содержать не менее одной цифры, одного спецсимвола (!@#$%^&*), и по одной латинской в верхнем и нижнем регистрах.'
                    ])
                ],
                'first_options'  => [
                    'label' => 'Пароль',
                    'attr' => [
                        'class' => 'input__text',
                        'placeholder' => 'Введите пароль'
                    ]
                ],
                'second_options' => [
                    'label' => 'Повторный пароль',
                    'attr' => [
                        'class' => 'input__text',
                        'placeholder' => 'Повторите пароль'
                    ]
                ],
                'invalid_message' => 'Пароли не совпадают.',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
