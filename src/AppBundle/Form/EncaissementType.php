<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncaissementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('appel', EntityType::class, array(
                'class' => 'AppBundle:Appel',
                'label' => 'Appel',
                'required' => true,
                'attr' => array('class' => 'form-control  select-chosen')
            ))
            
            ->add('dateCreate',DateType::class, array(
                'label' => 'Date Encaissement',
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => true,
                'format' => 'dd/mm/yyyy',
                'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
            ))
            ->add('montantEncaisse', NumberType::class, array(
                'label' => 'Montant Encaissé',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('numeroCompte', TextType::class, array(
                'label' => 'Numéro de compte',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))

             ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Encaissement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_encaissement';
    }


}
