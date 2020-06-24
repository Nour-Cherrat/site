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
                'choices' => $this->getStatus(),
                'label' => 'Ajouter au slider'
            ])
            ->add('event', ChoiceType::class, [
                'choices' => $this->getEvent(),
                'label' => 'Ajouter au timeline'
            ])
            ->add('pdfFile', FileType::class, [
                'label' => 'Fichier',
                'required' => false
            ])
            ->add('date_debut')
            ->add('date_fin')
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

    private function getStatus()
    {
        $choices = Annonce::STATUT;
        $output = [];
        foreach ($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }

    private function getEvent()
    {
        $choices = Annonce::EVENT;
        $output = [];
        foreach ($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }
}
