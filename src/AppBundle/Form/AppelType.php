<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('referenceAppel')->add('dateAppel')->add('refEngagement')->add('dateEngagement')->add('refBordereau')->add('dateBordereau')->add('montantHt')->add('montantTtc')->add('dateCreate')->add('userCreate')->add('dateModif')->add('userModif')->add('estAnnuler')->add('montant')->add('solde')        ;
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
