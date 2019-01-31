<?php

namespace AppBundle\Form;

use AppBundle\Entity\Projekty;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperacjaWynagrodzenieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imieINazwisko',
                TextType::class,
                [
                    'required' => true,
                ]

                )
            ->add('okresOd',
                DateType::class
            )
            ->add('okresDo',
                DateType::class
            )
            ->add('projekt',
                EntityType::class,
                [
                    'class'    => Projekty::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.nazwa', 'ASC');
                    },
                    'choice_label' => 'nazwa',
                    'placeholder' => 'Wybierz',
                    'required' => true,
                    'multiple' => false,
                    'label' => 'Projekt',
                ]
            );
    }/**
     * {@inheritdoc}
//     */
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'AppBundle\Entity\Projekty'
//        ));
//    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_operacjawynagrodzenie';
    }


}
