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
                'label' => 'Image',
                'required' => false
            ])
            ->add('statut', ChoiceType::class, [
                'choices'  => [
                    'Ne pas ajouter au slider' => 0,
                    'Ajouter au slider' => 1,
                ],
            ])
            ->add('pdfFile', FileType::class, [
                'label' => 'Fichier',
                'required' => false
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
            'translation_domain' => 'forms'
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
