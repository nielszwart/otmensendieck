<?php

namespace App\Form;

use App\Entity\ContentBlock;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentBlockFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, ['label' => 'Code', 'required' => true])
            ->add('content', CKEditorType::class, ['label' => 'Content', 'required' => false])
            ->add('imageFile', VichImageType::class, [
                'label' => 'File',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContentBlock::class,
        ]);
    }
}
