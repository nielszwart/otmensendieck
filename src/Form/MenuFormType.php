<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, ['label' => 'Code', 'required' => true, 'disabled' => $options['is_edit']])
            ->add('name', TextType::class, ['label' => 'Name', 'required' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
            'is_edit' => false,
        ]);
    }
}
