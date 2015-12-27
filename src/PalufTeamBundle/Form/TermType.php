<?php

namespace PalufTeamBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class TermType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', TimeType::class, ['label' => 'Od'])
            ->add('end', TimeType::class, ['label' => 'Do'])
            ->add('place', TextType::class, ['label' => 'Místo'])
            ->add('gps', TextType::class, ["required" => false, 'label' => 'GPS souřadnice'])
            ->add('count', IntegerType::class, ['label' => 'Počet hráčů'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'PalufBundle\Entity\Term',
        ]);
    }

}