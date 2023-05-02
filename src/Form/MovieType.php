<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom du film',
                'attr' => ['placeholder' => 'Entrez le nom du film']
            ))
            ->add('resume', TextareaType::class, array(
                'label' => 'Description',
                'attr' => ['placeholder' => 'Entrez la description du film']
            ))
            ->add('releaseDate', DateType::class)
            ->add('duration', TimeType::class)
            ->add('genres', TextareaType::class)
            ->add('imageFile', VichImageType::class)
            ->add('casting', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
