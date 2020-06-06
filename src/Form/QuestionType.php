<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите заголовок вопроса.'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Заголовок должен содержать минимум {{ limit }} символа',
                        // max length allowed by Symfony for security reasons
                        'max' => 63,
                        'maxMessage' => 'Заголовок должен содержать до {{ limit }} символов',
                    ])
                ],
                'attr' => [
                    'class' => 'input__text'
                ]
            ])
            ->add('qtext', TextareaType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите вопрос.'
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Текст вопроса содержать минимум {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 1000,
                        'maxMessage' => 'Текст вопроса должен содержать до {{ limit }} символов',
                    ])
                ],
                'attr' => [
                    'class' => 'input__text',
                    'rows' => "10"
                ]
            ])
            ->add('category', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите заголовок вопроса.'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Название категории должно состоять минимум из {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                        'maxMessage' => 'Название категории должно содержать до {{ limit }} символов',
                    ])
                ],
                'attr' => [
                    'class' => 'input__text'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
