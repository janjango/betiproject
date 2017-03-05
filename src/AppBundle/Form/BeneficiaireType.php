<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeneficiaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, array(
                'label' => 'Code Structure ',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('libBeneficiaire', TextType::class, array(
            'label' => 'Nom Structure',
            'attr' =>array(
                'class' =>'form-control'
            )))
            ->add('numeroCompte', IntegerType::class, array(
                'label' => 'Numéro Compte',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('intituleCompte', TextType::class, array(
                'label' => 'Intitulé Compte',
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
            'data_class' => 'AppBundle\Entity\Beneficiaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_beneficiaire';
    }


}
