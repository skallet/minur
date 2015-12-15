<?php

namespace PalufTeamBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 08.12.2015
 * Time: 23:54
 */
class CommentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Vložit komentář'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => "PalufTeamBundle\\FormData\\CommentData",
        ]);
    }

}