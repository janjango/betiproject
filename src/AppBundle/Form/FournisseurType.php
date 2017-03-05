<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, array(
                'label' => 'Code ',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('nom', TextType::class, array(
                'label' => 'Nom',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('numifu', TextType::class, array(
                'label' => 'N° IFU',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('tel', TextType::class, array(
                'label' => 'Contact(s)',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('email', TextType::class, array(
                'label' => 'email',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('adresse', TextareaType::class, array(
                'label' => 'Adresse',
                'attr' =>array(
                    'class' =>'form-control'
                ))) ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Fournisseur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_fournisseur';
    }


}
