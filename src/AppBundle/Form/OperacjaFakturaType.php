<?php

namespace AppBundle\Form;

use AppBundle\Entity\KontrahenciFaktur;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class OperacjaFakturaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

//        var_dump($options);die();

        $builder
//            ->add('nazwa', EntityType::class,
//                [
//                    'class' => KontrahenciFaktur::class
//                ]
//            )
            ->add('nazwa', Select2EntityType::class, [
                'multiple' => false,
                'remote_route' => 'operacje_ustaw_kategorie',
                'remote_params' => ['id' => 982],
                'class' => KontrahenciFaktur::class,
                'primary_key' => 'id',
                'text_property' => 'nazwa',
                'minimum_input_length' => 2,
                'page_limit' => 10,
                'allow_clear' => true,
                'delay' => 250,
                'cache' => false,
                'cache_timeout' => 60000, // if 'cache' is true
                'language' => 'pl',
                'placeholder' => 'Wpisz nazwę kontrahenta',
                // 'object_manager' => $objectManager, // inject a custom object / entity manager
            ]);

//            ->add('faktura', Select2EntityType::class, [
//                'required' => true,
//                'multiple' => false,
//                'remote_route' => 'ajax_autocomplete',
//                'class' => City::class,
//                'minimum_input_length' => 0,
//                'page_limit' => 10,
//                'scroll' => true,
//                'allow_clear' => false,
//                'req_params' => ['county' => 'parent.children[county]'],
//                'property' => 'name',
//                'callback'    => function (QueryBuilder $qb, $data) {
//                    $qb->andWhere('e.county = :county');
//
//                    if ($data instanceof Request) {
//                        $qb->setParameter('nazwa', $data->get('nazwa'));
//                    } else {
//                        $qb->setParameter('nazwa', $data['nazwa']);
//                    }
//
//                },
//            ]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\KontrahenciFaktur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_operacjafaktura';
    }


}
