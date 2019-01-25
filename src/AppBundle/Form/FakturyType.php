<?php

namespace AppBundle\Form;

use AppBundle\Entity\Projekty;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FakturyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rodzaj')
            ->add('naszaFirmaId')
            ->add('kontrahent')
            ->add('numer')
            ->add('dataWystawienia')
            ->add('kontrahentNrKonta')
            ->add('kwotaNetto')
            ->add('kwotaBrutto')
            ->add('kwotaVat')
            ->add('opis')
            ->add('formaPlatnosci')
            ->add('plikSkanFaktury')
            ->add('czyZaplacono')
            ->add('terminPlatnosci')
            ->add(
                'projekt',
                EntityType::class,
                [
                    'class'    => Projekty::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.nazwa', 'ASC');
                    },
                    'choice_label' => 'nazwa',
                    'placeholder' => 'Wybierz',
                    'required' => false,
                    'multiple' => false,
                    'label' => 'Projekt',
                ]
            );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Faktury'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_faktury';
    }


}
