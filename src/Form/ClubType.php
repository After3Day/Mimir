<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Address;
use App\Entity\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clubName', TextType::class, [
                'label' => false,
                'required' => true])
            ->add('contact', ContactType::class, [
                'label' => false])
            ->add('address', AddressType::class, [
                'label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
