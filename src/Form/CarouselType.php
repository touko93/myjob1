<?php

namespace App\Form;

use App\Entity\Carousel;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // // ->add('imageName')
            // ->add('imageFile',FileType::class,["label" =>"Image", "required" => true])
            ->add('text', CKEditorType::class,["label"=>"le texte", "required" => true])
            ->add('title', TextType::class,["help"=>"le titre de l'image", "help_attr"=>["class"=>"text-primary"], "label"=>"le titre", "required" => true])
            ->add('tag', ChoiceType::class,["label"=>"Tag", "choices" => [
                "home"=>"home",
                "cartes"=>"cartes",
                "annonce"=>"annonce",
                "candidat"=>"candidat",
                "entreprise"=>"entreprise",
                "formation"=>"formation",
            ]
            ])
            ->add('imageFile',FileType::class,["label" =>"Image 1", "required" => true])
            
        //     ->add('cartes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carousel::class,
        ]);
    }
}
