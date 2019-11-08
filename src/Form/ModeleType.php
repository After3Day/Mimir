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
                'choice_label' => 'brandName'])
            ->add('modele', TextType::class, [
                'label' => false])
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
                'prototype' => true,
                'by_reference' => false])
            ->add('designers', EntityType::class, [
                'class' => Designer::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.name', 'ASC');
                },
                'label' => false,
                'choice_label' => 'name',
                'mapped' => false])
            ->add('collectors', EntityType::class, [
                'class' => Collector::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('b')
                        ->join('b.contact' , 'bc')
                        ->orderBy('bc.name', 'ASC');
                },
                'label' => false,
                'choice_label' => 'contact.name',
                'mapped' => false])
            //add Média !!
            ->add('save', SubmitType::class, ['label' => 'Enregister'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
