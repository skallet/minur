<?php

namespace PalufAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 07.12.2015
 * Time: 23:42
 */
class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('start')
            ->add('end')
            ->add('description')
            ->add('deadline')
            ->add('cntRounds')
            ->add('cntTeams')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'PalufBundle\Entity\Tournament',
        ]);
    }


}