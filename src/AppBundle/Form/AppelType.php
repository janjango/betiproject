<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('sourceAlimaentation', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, array(
                'label' => "Choisir la catégorie",
                'attr' => array('class' => 'form-control  select-chosen'),
                'choices' => array(
                    'Appel de fonds sur budget national' => 'one',
                    'Appel de fonds sur autre budget' => "two",
                ),
                'required' => true,
                'mapped'=> false,
            ))

            ->add('referenceAppel', TextType::class, array(
                'label' => 'Référence Appel émis',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('dateAppel',DateType::class, array(
                    'label' => 'Date Emission',
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'required' => true,
                     'format' => 'dd/mm/yyyy',
                    'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
                ))
            ->add('refEngagement', TextType::class, array(
                'label' => 'Référence Engagement',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('dateEngagement',DateType::class, array(
                'label' => 'Date Engagement',
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => false,
                'format' => 'dd/mm/yyyy',
                'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
            ))
            ->add('refBordereau', TextType::class, array(
                'label' => 'Référence Bordereau',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('dateBordereau',DateType::class, array(
                'label' => 'Date Bordereau',
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => false,
                'format' => 'dd/mm/yyyy',
                'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
            ))

            ->add('objetappel', TextareaType::class, array(
                'label' => 'Objet Appel émis',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))

            ->add('beneficiaire', EntityType::class, array(
                'class' => 'AppBundle:Beneficiaire',
                'label' => 'Structure Bénéficiaire',
                'placeholder' => 'Choose an option',
                'required' => true,
                'attr' => array('class' => 'form-control  select-chosen')
            ))
//            ->add('objetappel', EntityType::class, array(
//                'class' => 'AppBundle:ObjetAppel',
//                'label' => 'Objet',
//                'required' => true,
//                'attr' => array('class' => 'form-control  select-chosen')
//            ))

            ->add('montantTtc', NumberType::class, array(
                'label' => 'Montant',
                'attr' =>array(
                    'class' =>'form-control'
                )))

//            ->add('numcomptetresor', TextType::class, array(
//                'label' => 'Numéro du compte trésor',
//                'required' => false,
//                'attr' =>array(
//                    'class' =>'form-control'
//                )))
//
//            ->add('intitulecomptetresor', TextType::class, array(
//                'label' => 'Intitulé du compte trésor',
//                'required' => false,
//                'attr' =>array(
//                    'class' =>'form-control'
//                )))

            ->add('observation', TextareaType::class, array(
                'label' => 'Observations',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Appel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_appel';
    }


}
