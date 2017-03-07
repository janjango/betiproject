<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\EncaissementRepository;
use AppBundle\Repository\AppelRepository;

class CoffrefortType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('sourceAlimaentation', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, array(
                    'label' => "Source d'alimaentation",
                    'attr' => array('class' => 'form-control  select-chosen'),
                    'choices' => array(
                        'Encaissament' => 'encaissement',
                        'Autre' => "autre",
                    ),
                    'required' => true
                ))
                ->add('appel', EntityType::class, array(
                    'class' => 'AppBundle:Appel',
                    'label' => 'Appel',
                    'placeholder' => 'Choose an option',
                    'required' => true,
                    'attr' => array('class' => 'form-control  select-chosen'),
                    
                    'query_builder' => function (AppelRepository $repository) {
                return $repository->createQueryBuilder('a')
                        ->where('a.estAnnuler = 0')
                        ->andWhere('a.estParentannuler = 0')
                        ->andWhere('a.estSolder = 0')
                        ->orWhere('a.estSolder is null')
                ;
            },'mapped' => false,
                ))
                ->add('encaissement', EntityType::class, array(
                    'class' => 'AppBundle:Encaissement',
                    'label' => 'Encaissement',
                    'required' => true,
                    'placeholder' => "Choississez un encaissement",
                    'attr' => array('class' => 'form-control  select-chosen'),
                ))
                ->add('autreAlimaentation', TextType::class, array(
                    'label' => 'Précisez la source',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('dateEmission', DateType::class, array(
                    'label' => 'Date Emission',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'input' => 'datetime',
                    'required' => true,
                    'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
                ))
                ->add('refCheque', TextType::class, array(
                    'label' => 'Référence du chèque',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('libOperation', TextType::class, array(
                    'label' => 'Libellé de Opération',
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('montantRetire', NumberType::class, array(
                    'label' => 'Montant Retiré',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                // ->add('beneficiaire')
                ->add('observation', TextareaType::class, array(
                    'label' => 'Observation',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Coffrefort'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_coffrefort';
    }

}
