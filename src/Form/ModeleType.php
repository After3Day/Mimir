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
                'label' => 'Marque',
                'choice_label' => 'brandName'])
            ->add('modele')
            // numéro moteur
            // chassis
            // boîte
            // identification
            ->add('versions', CollectionType::class, [
                'entry_type' => VersionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'label' => false,
                'prototype' => true,
                'by_reference' => false])
            ->add('designers', CollectionType::class, [
                'entry_type' => DesignerType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'label' => false,
                'prototype' => true,
                'by_reference' => false])
            // médias
            // collector
            ->add('save', SubmitType::class, ['label' => 'Enregister'])

/*
            ->add('versions', EntityType::class, [
                'class' => Version::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('v')
                        ->orderBy('v.versionName', 'ASC');
                },
                'choice_label' => 'versionName'])

            ->add('medias', EntityType::class, [
                'class' => Media::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.type', 'ASC');
                },
                'choice_label' => 'type'])

            ->add('collectors', EntityType::class, [
                'class' => Collector::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->join('c.contact', 'cc')
                        ->orderBy('cc.surname', 'ASC');
                },
                'choice_label' => 'contact.surname'])

            ->add('designers', EntityType::class, [
                'class' => Designer::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('d')
                        ->orderBy('d.surname', 'ASC');
                },
                'choice_label' => 'surname'])
*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
