<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

             $builder
                 ->add('imageFile', VichImageType::class, [
                        'label' => 'Image (fichier JPG ou PNG)',
                        'required' => false,
                        'allow_delete' => true,
                        'delete_label' => 'Supprimer l\'image',
                        'download_label' => 'Télécharger',
                        'download_uri' => true,
                ])
            ->add('title')
            ->add('article')
            ->add('prenom')
            ->add('nom')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
