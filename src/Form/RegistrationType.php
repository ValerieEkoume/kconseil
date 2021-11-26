<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email', EmailType::class, [
                'attr'=>[
                    'placeholder'=>"Un email de confirmation vous sera envoyé"
                ],
                'label'=>"Email",

            ])
            ->add('password', PasswordType::class, [
                'label'=>"Mot de Passe"
            ]);
    }


    public function getDefaultOptions(array $options)
    {
        return array('data_class'=>'Acme\AccountBundle\Entity\User');
    }

    public function getName()
    {
        return 'user';
    }
}