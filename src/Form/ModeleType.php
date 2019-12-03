<?php

namespace App\Form;

Use App\Entity\Modele;
Use App\Entity\Brand;
Use App\Entity\Club;
Use App\Entity\Event;
Use App\Entity\Collector;
Use App\Entity\Designer;
Use App\Entity\Version;
Use App\Entity\Media;

use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ModeleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.brandName', 'ASC');
                },
                'label' => false,
                'choice_label' => 'brandName',
                'multiple' => false,
                'placeholder' => 'Choisir une marque'])
            ->add('modele', TextType::class, [
                'label' => false])
            ->add('year',ChoiceType::class, [
                'choices' => $this->getYears(1870),
                'label' => false,
                'placeholder' => 'Choisir une année'
            ])
            ->add('engine', TextType::class, [
                'label' => false,
                'required' => false])
            ->add('gearbox', TextType::class, [
                'label' => false,
                'required' => false])
            ->add('frame', TextType::class, [
                'label' => false,
                'required' => false])
            ->add('identification', TextType::class, [
                'label' => false,
                'required' => false])
            // numéro moteur
            // chassis
            // boîte
            // identification
            ->add('versions', CollectionType::class, [
                'entry_type' => VersionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'required' => false,
                'prototype' => true,
                'by_reference' => false])
            ->add('designers', EntityType::class, [
                'class' => Designer::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.name', 'ASC');
                },
                'label' => false,
                'choice_label' => function ($er) {
                    return $er->getSurname() . ' ' . $er->getName();
                },
                'mapped' => false,
                'required' => false,
                'multiple' => false,
                'placeholder' => 'Choisir un Designer'])
            ->add('collectors', EntityType::class, [
                'class' => Collector::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.name', 'ASC');
                },
                'label' => false,
                'choice_label' => function ($er) {
                    return $er->getSurname() . ' ' . $er->getName();
                },
                'mapped' => false,
                'required' => false,
                'multiple' => false,
                'placeholder' => 'Choisir un Collectionneur'])
            //add Média !!
            ->add('save', SubmitType::class, ['label' => 'Enregister'])

        ;
    }

    private function getYears($min, $max='current')
    {
         $years = range($min, ($max === 'current' ? date('Y') : $max));

         return array_combine($years, $years);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
