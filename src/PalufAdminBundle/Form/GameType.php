<?php

namespace PalufAdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 07.12.2015
 * Time: 23:42
 */
class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teamA', EntityType::class, array(
                'class' => 'PalufBundle:Team',
                'choice_label' => 'name',
            ))
            ->add('teamB', EntityType::class, array(
                'class' => 'PalufBundle:Team',
                'choice_label' => 'name',
            ))
            ->add('round')
            ->add('done')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'PalufBundle\Entity\Game',
        ]);
    }


}