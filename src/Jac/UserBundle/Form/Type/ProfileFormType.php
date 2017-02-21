<?php

/**
 * Description of ProfileFormType
 *
 * @author Jacques
 */

namespace Ben\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Ben\UserBundle\Form\Type\ResettingFormType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use libphonenumber\PhoneNumberFormat;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends BaseType {

    protected $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class) {
        parent::__construct($class);
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        // Ajoute le champ personnalisé aux formulaires de mise à jour du profile
        $builder
//                ->add('plainPassword', ResettingFormType::class, array(
//                    'required' => false,
//                ))
                ->add('firstname', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.firstname',
                    )
                ))
                ->add('lastname', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'registration.lastname',
                    )
                ))
                ->add('phone', PhoneNumberType::class, array(
                    'default_region' => 'BJ',
                    'format' => PhoneNumberFormat::NATIONAL,
                    'widget' => PhoneNumberType::WIDGET_COUNTRY_CHOICE,
                    'country_choices' => array('BJ', 'TG', 'NE', 'NG'),
                    'preferred_country_choices' => array('BJ', 'TG', 'NE'),
                    'attr' => array(
                        'placeholder' => 'registration.phone',
                    )
                ))
//                ->add('username', TextType::class, array(
//                    'attr' => array(
//                        'placeholder' => 'registration.name',
//                    )
//                ))
//                ->add('email', EmailType::class, array(
//                    'attr' => array(
//                        'placeholder' => 'registration.form_email',
//                    )
//                ))
                ->add('user_category', EntityType::class, array(
                    'class' => 'AppBundle:User\UserCategory',
                    'placeholder' => 'Vous êtes',
                    'required' => true
                ))
                ->add('fields', EntityType::class, array(
                    'class' => 'AppBundle:User\Field',
                    'placeholder' => '',
                    'required' => true,
                    'multiple' => true,
                ))
//                ->add('profil', TextType::class, array(
//                    'attr' => array(
//                        'placeholder' => '',
//                    )
//                ))
//                ->add('oldPlainPassword', PasswordType::class, array(
//                    'constraints' => array(
//                        new UserPassword(),
//                    ),
//                    'mapped' => false,
//                    'required' => true,
//                    'label' => 'Current Password',
//                ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention' => 'profile',
            'translation_domain' => 'FOSUserBundle',
            'validators' => 'validators'
        ));
    }

    public function getBlockPrefix() {
        return 'ben_user_profile';
    }

    // For Symfony2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
