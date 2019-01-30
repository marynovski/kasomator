<?php

namespace AppBundle\Form;

use AppBundle\Helper\OpisOperacjiDeterminator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('opisOperacji',
                ChoiceType::class,
                [
                    'placeholder' => 'Wybierz',
                    'choices'  => [
                        'Przelew Zewnętrzny Wychodzący'   => OpisOperacjiDeterminator::PRZELEW_ZEWNETRZNY_WYCHODZACY_ID,
                        'Przelew Zewnętrzny Przychodzący' => OpisOperacjiDeterminator::PRZELEW_ZEWNETRZNY_PRZYCHODZACY_ID,
                        'Przelew Wewnętrzny Wychodzący' => OpisOperacjiDeterminator::PRZELEW_WEWNETRZNY_WYCHODZACY_ID,
                        'Przelew Własny' => OpisOperacjiDeterminator::PRZELEW_WLASNY_ID,
                        'Blik Zakup' => OpisOperacjiDeterminator::BLIK_ZAKUP_ID,
                        'Przelew MTRANSFER Wychodzący' => OpisOperacjiDeterminator::PRZELEW_MTRANSFER_WYCHODZACY_ID,
                        'Blik Wypłata ATM-KRAJOWY' => OpisOperacjiDeterminator::BLIK_WYPLATA_ATM_KRAJOWY_ID,
                        'Przelew Ekspresowy' => OpisOperacjiDeterminator::PRZELEW_EKSPRESOWY_ID,
                        'Opłata-Przelew Ekspresowy' => OpisOperacjiDeterminator::OPLATA_PRZELEW_EKSPRESOWY_ID,
                        'Zakup Przy Użyciu Karty' => OpisOperacjiDeterminator::ZAKUP_PRZY_UZYCIU_KARTY_ID,
                        'Wypłata w Bankomacie' => OpisOperacjiDeterminator::WYPLATA_W_BANKOMACIE_,
                        'Prowizja Wypłata Bankomat Krajowy' => OpisOperacjiDeterminator::PROWIZJA_WYPLATA_BANKOMAT_KRAJOWY_ID,
                        'Blik Zakup E-Commerce' => OpisOperacjiDeterminator::BLIK_ZAKUP_E_COMMERCE_ID,
                        'Przelew SORBNET Wychodzący' => OpisOperacjiDeterminator::PRZELEW_SORBNET_WYCHODZACY_ID,
                        'Opłata Przelew SORBNET Wychodzący' => OpisOperacjiDeterminator::OPLATA_PRZELEW_SORBNET_WYCHODZACY_ID,
                    ]
                ])
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
