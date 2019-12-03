<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class, [
                'required' => true,
                'label' => 'Type de document'])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom du document'])
            ->add('number', TextType::class, [
                'required' => false,
                'label' => 'Numéro'])
            ->add('releaseDate', TextType::class, [
                'required' => false,
                'label' => 'Date de parution/Date de sortie',
                'attr'=>['placeholder' => 'AA/MM/JJ']])
            ->add('author', TextType::class, [
                'required' => false,
                'label' => 'Auteur'])
            ->add('webLink', UrlType::class, [
                'required' => false,
                'label' => 'Lien wikipédia'])
            ->add('repertory', TextType::class, [
                'required' => false,
                'label' => 'Dossier/Répértoire'])
            ->add('language', TextType::class, [
                'required' => false,
                'label' => 'Langue'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
