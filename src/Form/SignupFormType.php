<?php

namespace App\Form;

use App\Entity\Signup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignupFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Naam', 'required' => true])
            ->add('phone', TextType::class, ['label' => 'Telefoonnummer', 'required' => true])
            ->add('complaints', TextareaType::class, ['label' => 'Uw klacht(en)', 'required' => true])
            ->add('email', EmailType::class, ['label' => 'E-mailadres', 'required' => false])
            ->add('address', TextType::class, ['label' => 'Adres', 'required' => false])
            ->add('city', TextType::class, ['label' => 'Stad', 'required' => false])
            ->add('postal_code', TextType::class, ['label' => 'Postcode', 'required' => false])
            ->add('reference', CheckboxType::class, ['label' => 'Verwijzing van huisarts?', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Signup::class,
        ]);
    }
}
