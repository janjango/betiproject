<?php
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class RetenuePaieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateVersement',DateType::class, array(
                'label' => 'Date Versement',
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => true,
                'format' => 'dd/mm/yyyy',
                'attr' => array('class' => 'input-datepicker form-control ', 'data-date-format' => 'dd/mm/yyyy',),
            ))
           ->add('tvaAreverse', NumberType::class, array(
               'label' => 'TVA Reversée',
               'required' => false,
               'attr' =>array(
                   'class' =>'form-control'
               )))
            ->add('aibAreverse', NumberType::class, array(
                'label' => 'AIB Reversé',
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
            'data_class' => 'AppBundle\Entity\RetenuePaie'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_retenuepaie';
    }
}