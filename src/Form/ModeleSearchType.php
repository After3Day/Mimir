<?php

namespace App\Form;

use App\Entity\Modele;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ModeleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->remove('manufacturerName')

            ->add('Marque', EntityType::class, array(
        'class'         => Modele::class,
        'choice_label'  => 'manufacturerName',
        'multiple'      => false,
      ))
    ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();

            $formOptions = [
                'class'         => Modele::class,
                'choice_label'  => 'modele',
                'multiple'      => false,

            ];

            $form->add('modele', EntityType::class, $formOptions);
    });
    }

    public function getParent()
      {
        return ModeleType::class;
      }
}
