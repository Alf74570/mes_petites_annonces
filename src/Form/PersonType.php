<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                "label"=> "Pseudo"
            ])
            ->add('firstname', TextType::class, [
                "label"=> "Prénom"
            ])
            ->add('lastname', TextType::class, [
                "label"=> "Nom"
            ])
            ->add('email', TextType::class, [
                "label"=> "Email"
            ])
            ->add('phonenumber',TextType::class, [
                "label"=> "Téléphone"
            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,

                'first_options'  => array('label' => 'Mot de Passe'),
                'second_options' => array('label' => 'Confirmation du Mot de Passe'),

                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Password'),

            ))
            ->add('submit', SubmitType::class, ['label'=>'Mettre à Jour', 'attr'=>['class'=>'btn-primary btn-block']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
