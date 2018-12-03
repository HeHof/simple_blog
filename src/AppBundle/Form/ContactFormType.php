<?php

declare(strict_types = 1);

namespace AppBundle\Form;

use AppBundle\DataObject\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'label.name'])
            ->add('email', EmailType::class, ['label' => 'label.email'])
            ->add('phone', TelType::class, ['label' => 'label.phone'])
            ->add('message', TextType::class, ['label' => 'label.message']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Contact::class,
            ]
        );
    }
}
