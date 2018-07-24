<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', TextType::class, [
                "label" => "Catégorie"
            ])
            ->add('creation_date', DateType::class, [
                "label" => "Date de Création", "data" => new \DateTime()
            ])
            ->add('title', TextType::class, [
                "label" => "Titre"
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description"
            ])
            ->add('price', IntegerType::class,[
                "label" => "Prix"
            ])
            ->add('country', TextType::class, [
                "label" => "Région"
            ])
            ->add('submit', SubmitType::class, ['label'=>'Envoyer', 'attr'=>['class'=>'btn-primary btn-block']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
