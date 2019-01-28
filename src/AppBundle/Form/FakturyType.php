<?php

namespace AppBundle\Form;

use AppBundle\Entity\NaszeFirmy;
use AppBundle\Entity\Projekty;
use AppBundle\Helper\FakturyTypes;
use AppBundle\Helper\FormyPlatnosciTypes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FakturyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'rodzaj',
                ChoiceType::class,
                [
                    'placeholder' => 'Wybierz',
                    'choices'  => [
                        'Polska'        => FakturyTypes::POLSKA,
                        'Zagraniczna'   => FakturyTypes::ZAGRANICZNA,
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
                    'label' => 'Obciążana firma',
                ]
            )
            ->add('kontrahent')
            ->add('numer')
            ->add('dataWystawienia')
            ->add('kontrahentNrKonta')
            ->add('kwotaNetto')
            ->add('kwotaBrutto')
            ->add('kwotaVat')
            ->add('opis')
            ->add('formaPlatnosci',
                ChoiceType::class,
                [
                    'placeholder' => 'Wybierz',
                    'choices'  => [
                        'Gotówka'   => FormyPlatnosciTypes::GOTOWKA,
                        'Karta'     => FormyPlatnosciTypes::KARTA,
                        'Przelew'   => FormyPlatnosciTypes::PRZELEW,
                    ]
                ]
            )
            ->add('plikSkanFaktury',
                FileType::class,
                [
                    'label' => 'Plik skanu faktury',
                    'required' => true,
                    'data_class' => null,
                    'attr' => [
                        'accept' => 'text/csv',
                    ]
                ]
            )
            ->add('czyZaplacono',
                ChoiceType::class,
                [
                    'placeholder' => 'Wybierz',
                    'choices'  => [
                        'TAK'   => true,
                        'NIE'     => false,
                    ]
                ]
            )
//            ->add('terminPlatnosci')
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

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $form = $event->getForm();



                $form->add('terminPlatnosci');
        });

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
