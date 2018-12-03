<?php

declare(strict_types = 1);

namespace AppBundle\Form;

use AppBundle\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'label.first_name'])
            ->add('lastName', TextType::class, ['label' => 'label.last_name'])
            ->add('userName', TextType::class, ['label' => 'label.user_name_choice'])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'label.password'),
                'second_options' => array('label' => 'label.repeat_password')
            ])
            ->add('email', EmailType::class, ['label' => 'label.email']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Users::class,
            ]
        );
    }
}
