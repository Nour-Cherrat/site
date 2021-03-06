<?php

namespace App\Form;

use App\Entity\Alumni;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlumniType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('filiere')
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'required' => false
            ])
            ->add('quote')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Alumni::class,
        ]);
    }
}
