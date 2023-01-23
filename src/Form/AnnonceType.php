<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Compagny;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AnnonceType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["label" => "Nom", "required" => true])
            ->add('imageFile', FileType::class, ["label" => "Annonce", "required" => $options['imageRequired']])
            ->add('text', CKEditorType::class,["label"=>"Description de l'annonce", "required" => false])
            ->add('title', TextType::class, ["label" => "Titre", "required" => false, "attr"=>["maxlength" =>65],"constraints" =>[new Length(["max"=>65,"maxMessage"=>"Votre titre doit avoir 65 carractères maximum"])]])
            ->remove('imageName')
            ->add('tag', ChoiceType::class, ["label" => "Type d'annonce", "choices"=>[
            "cdi"=>"cdi",
            "cdd"=>"cdd",
            "interim"=>"interim",
            "formation"=>"formation",

            ]])
            ->add('compagny', EntityType::class, ["label" => "compagny","class"=>Compagny::class,"required" => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
            'imageRequired'=>true,
            
        ]);
    }
    
    
}

