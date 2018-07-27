<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $response = json_decode(file_get_contents('https://geo.api.gouv.fr/regions?fields=nom'),true);
        $myRegions = array_map(function($el){
            return $el['nom'];
        }, $response);

        $builder
            ->add('search' , TextType::class , [
                'label' => false,
                'attr'=>['placeholder'=>'Mots Clés'],
                'required' => false
            ])
            ->add('country', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'choices'=>$myRegions,
                'choice_label'=>function($choiceValue, $key,$value){
                    if($value == $choiceValue){
                        return $value;
                    }
                    return strtoupper($key);
                }])
            ->add('category' , TextType::class , [
                'label' => false,
                'attr'=>['placeholder'=>'Catégorie'],
                'required' => false
            ])
            ->add('author' , TextType::class , [
                'label' => false,
                'required' => false,
                'attr'=>['placeholder'=>'Vendeur'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
