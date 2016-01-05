<?php

namespace PalufBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('email', EmailType::class, array('label' => 'Emailová adresa:'))
            ->add('password', PasswordType::class, array('label' => 'Heslo (minimálně 5 znaků):'))
            ->add('passwordCheck', PasswordType::class, array('label' => 'Zopakujte heslo:'))
            ->add('name', TextType::class, array('label' => 'Název týmu:'))
            ->add('description', TextareaType::class, ["required" => false, 'label' => 'O týmu:'])
            ->add('send', SubmitType::class, array('label' => 'Registrovat tým'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => "PalufBundle\\FormData\\RegistrationData",
        ]);
    }


}