<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperacjeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                HiddenType::class,
                [
                    'data' => \AppBundle\Helper\OperacjeType::GOTOWKOWE,
                ]
            )
            ->add('dataOperacji')
            ->add('dataKsiegowania')
            ->add('opisOperacji')
            ->add('tytul')
            ->add('kontrahent')
            ->add('nrKonta')
            ->add('kwota')
            ->add('saldoPoOperacji');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Operacje'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_operacje';
    }


}
