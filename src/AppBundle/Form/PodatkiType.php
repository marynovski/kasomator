<?php

namespace AppBundle\Form;

use AppBundle\Entity\NaszeFirmy;
use AppBundle\Helper\UrzedyTypes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PodatkiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('urzad',
                ChoiceType::class,
                [
                    'choices'  => [
                        'Urząd Skarbowy'        => UrzedyTypes::URZAD_SKARBOWY,
                        'ZUS'                   => UrzedyTypes::ZUS,
                        'Inne'                  => UrzedyTypes::INNE,
                    ]
                ]
            )
            ->add('naszaFirmaId',
                EntityType::class,
                [
                    'class'    => NaszeFirmy::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.nazwa', 'ASC');
                    },
                    'choice_label' => 'nazwa',
                    'placeholder' => 'Wybierz',
                    'required' => false,
                    'multiple' => false,
                    'label' => 'Nasza firma',
                ]
            )
            ->add('opis')
            ->add('okres')
            ->add('kwota')
            ->add('czyZaplacono',
                CheckboxType::class,
                [
                    'label' => 'Czy podatek jest zapłacony?',
                    'data' => true,

                ])
            ->add('terminPlatnosci');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Podatki'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_podatki';
    }


}
