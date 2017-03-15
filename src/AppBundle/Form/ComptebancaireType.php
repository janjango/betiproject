<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComptebancaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

               ->add('numero', TextType::class, array(
                'label' => 'Numéro Compte',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('intitule', TextType::class, array(
                'label' => 'Intitulé Compte',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('institution', TextType::class, array(
            'label' => 'Institution',
            'required' => false,
            'attr' =>array(
                'class' =>'form-control'
            )))  ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Comptebancaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_comptebancaire';
    }


}
