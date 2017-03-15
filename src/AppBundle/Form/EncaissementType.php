<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Repository\AppelRepository;

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
                'placeholder' => 'Choisir un document d\'appel',
                'required' => true,
                'attr' => array('class' => 'form-control  select-chosen'),
                'query_builder' => function (AppelRepository $repository)
                {
                    return $repository->createQueryBuilder('a')
                        ->where('a.estAnnuler = 0')
                        ->andWhere('a.estParentannuler = 0')
                        ->andWhere('a.estSolder = 0 or a.estSolder is null')
                       // ->orWhere('')

//                        ->setParameter(1, 'basic')
//                        ->add('orderBy', 's.sort_order ASC')
                        ;
                }
            ))
            
            ->add('dateCreate',DateType::class, array(
               'label' => 'Date Encaissement',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'input' => 'datetime',
                'required' => true,              
                'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
            ))
            ->add('montantEncaisse', NumberType::class, array(
                'label' => 'Montant Encaissé',
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