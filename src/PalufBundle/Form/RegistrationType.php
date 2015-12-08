<?php

namespace PalufBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 08.12.2015
 * Time: 20:06
 */
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('passwordCheck', PasswordType::class)
            ->add('name')
            ->add('description', TextareaType::class)
            ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => "PalufBundle\\FormData\\RegistrationData",
        ]);
    }


}