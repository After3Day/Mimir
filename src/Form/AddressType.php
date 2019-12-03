<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'required' => true])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required' => true])
            ->add('zipCode', IntegerType::class, [
                'label' => 'Code postal',
                'required' => true])
            ->add('street', TextType::class, [
                'label' => 'Rue',
                'required' => true])
            ->add('streetNumber', IntegerType::class, [
                'label' => 'Numéro de rue',
                'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
