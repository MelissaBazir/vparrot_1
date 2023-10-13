<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '3',
                    'maxlength' => '32'
                ],
                'label' => 'Votre nom',
                'label_attr' =>  [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('reviewText', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '255'
                ],
                'label' => 'Votre avis',
                'label_attr' =>  [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['max' => 255]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('score', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 4
                ],
                'label' => 'Votre note',
                'label_attr' =>  [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\GreaterThanOrEqual(1),
                    new Assert\LessThanOrEqual(4),
                    new Assert\NotBlank()
                ]
            ])
            // ->add('approved', CheckboxType::class, [
            // 'attr' => ['value' => 'false']
            // ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 mb-4'
                ],
                'label' => 'Envoyer mon avis'
            ]);

        // submit label to fix
        // $labelSubmit = "";
        // switch ($options['route']) {
        //     case 'review.new':
        //         $labelSubmit = "Ajouter un avis";
        //         break;
        //     case 'review.edit':
        //         $labelSubmit = "Modifier l'avis'";
        //         break;
        // }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'route' => null,
            'data_class' => Review::class,
        ]);
    }
}