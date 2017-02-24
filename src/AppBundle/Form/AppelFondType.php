<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppelFond extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('referenceAppel', TextType::class, array(
                'label' => 'Référence Appel',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('dateAppel')

            ->add('refEngagement')
            ->add('dateEngagement')
            ->add('refBordereau')
            ->add('dateBordereau')

            ->add('montantHt', IntegerType::class, array(
                'label' => 'Numéro Compte',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('montantTtc', IntegerType::class, array(
                'label' => 'Numéro Compte',
                'attr' =>array(
                    'class' =>'form-control'
                )))

            ->add('observation', TextareaType::class, array(
                'label' => 'Observations',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('estAnnuler')
            ->add('solde');
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
