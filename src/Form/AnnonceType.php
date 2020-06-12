<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('categorie', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Annonce::CATEGORIE;
        $output = [];
        foreach ($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }
}
