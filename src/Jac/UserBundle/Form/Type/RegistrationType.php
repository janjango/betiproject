<?php

namespace Jac\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use libphonenumber\PhoneNumberFormat;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
                ->add('gender', ChoiceType::class, array(
                    'choices' => array(
                        'M.' => 'M',
                        'Mme' => 'F',
                    ),
                    'placeholder' => 'Civilité',
                    'required' => true,
                    'attr' =>array('class' =>'form-control ')
                ))
                ->add('firstname', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.firstname',
                        'class' =>'form-control '
                    )
                ))
                ->add('lastname', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.lastname',
                        'class' =>'form-control '
                    )
                ))
                ->add('phone', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.phone',
                        'class' =>'form-control '
                    )
                ))
                ->add('username', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.name',
                        'class' =>'form-control '
                    )
                ))
                ->add('email', EmailType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.form_email',
                        'class' =>'form-control '
                    )
                ))
                ->add('plainPassword', PasswordType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.password',
                        'class' =>'form-control '
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Jac\UserBundle\Entity\User',
            'intention' => 'registration',
            'translation_domain' => 'FOSUserBundle',
            'validators' => 'validators'
        ));
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix() {
        return 'jac_user_registration';
    }

    // For Symfony2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
