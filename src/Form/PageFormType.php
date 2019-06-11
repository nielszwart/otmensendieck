<?php

namespace App\Form;

use App\Entity\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, ['label' => 'Code', 'required' => true])
            ->add('slug', TextType::class, ['label' => 'Slug', 'required' => true])
            ->add('title', TextType::class, ['label' => 'Title', 'required' => true])
            ->add('content', CKEditorType::class, ['label' => 'Content', 'required' => true])
            ->add('meta_title', TextType::class, ['label' => 'Meta title', 'required' => false])
            ->add('meta_keywords', TextType::class, ['label' => 'Meta keywords', 'required' => false])
            ->add('meta_description', TextType::class, ['label' => 'Meta description', 'required' => false])
            ->add('active', CheckboxType::class, ['label' => 'Active','required' => false])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
