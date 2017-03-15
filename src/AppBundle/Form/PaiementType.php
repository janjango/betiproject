<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Repository\EncaissementRepository;

class PaiementType extends AbstractType
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
                    'Virement' => 'one',
                    'Chèque' => "two",
                ),
                'required' => true
            ))

            ->add('fournisseur', EntityType::class, array(
                'class' => 'AppBundle:Fournisseur',
                'label' => 'Fournisseur',
                'placeholder' => 'Choisissez le fournisseur',
                'required' => true,
                'attr' => array('class' => 'form-control  select-chosen')
            ))

            ->add('encaissement', EntityType::class, array(
                'class' => 'AppBundle:Encaissement',
                'label' => 'Encaissement',
                'placeholder' => 'Choisissez l\'encaissement',
                'required' => true,
                'attr' => array('class' => 'form-control  select-chosen'),
                'query_builder' => function (EncaissementRepository $repository)
                {
                    return $repository->createQueryBuilder('en')
                        ->join('en.exercice', 'ex')
                        ->where('ex.estActif = 1')
                        ->andWhere('en.solde > 0')
                        ;
                }
            ))
            ->add('dateEPaiement',DateType::class, array(
                'label' => 'Date Paiement',
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => true,
                'format' => 'dd/mm/yyyy',
                'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
            ))
            ->add('refCheque', TextType::class, array(
                'label' => 'Référence Chèque',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('refVirement', TextType::class, array(
                'label' => 'Référence Virement',
                'required' => false,
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('montantHt', NumberType::class, array(
                'label' => 'Montant Hors Taxe',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('tvaRetenue', NumberType::class, array(
                'label' => 'TVA Retenue',
                'attr' =>array(
                    'class' =>'form-control'
                )))

            ->add('aibRetenu', NumberType::class, array(
                'label' => 'AIB Retenue',
                'attr' =>array(
                    'class' =>'form-control'
                )))
            ->add('montantTtc', NumberType::class, array(
                'label' => 'Montant TTC',
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
            'data_class' => 'AppBundle\Entity\Paiement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_paiement';
    }


}
