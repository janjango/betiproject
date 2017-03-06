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
class CoffrefortType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('encaissement', EntityType::class, array(
                'class' => 'AppBundle:Encaissement',
                'label' => 'Encaissement',
                'required' => true,
                'attr' => array('class' => 'form-control  select-chosen')
                ))
                ->add('dateEmission',DateType::class, array(
                'label' => 'Date Emission',
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => true,
                'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
                ))
                ->add('refCheque', TextType::class, array(
                'label' => 'Référence du chèque',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))
                ->add('libOperation', TextType::class, array(
                'label' => 'Libellé de Opération',
                'required' => true,
                'attr' =>array(
                    'class' =>'form-control'
                )))
                ->add('montantRetire', NumberType::class, array(
                'label' => 'Montant Retiré',
                'attr' =>array(
                    'class' =>'form-control'
                )))
                ->add('beneficiaire')
                ->add('observation', TextareaType::class, array(
                    'label' => 'Observation',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                )))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Coffrefort'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_coffrefort';
    }


}
