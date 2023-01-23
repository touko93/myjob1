<?php

namespace App\Form;

use App\Entity\Compagny;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('name',TextType::class,["label"=>"Nom","required"=> true])
            ->add('adres',TextType::class,["label"=>"Adresse","required"=> true])
            ->add('email',TextType::class,["label"=>"Email","required"=> true])
            ->add('phone',TextType::class,["label"=>"Telephone","required"=> true])
            ->remove('imageName')
            ->add('imageFile',FileType::class,["label" =>"Annonce", "required" => true])
            ->remove('updatedAt',DateTimeType::class,["widget"=>"single_text"])
            
            ->add('tag', ChoiceType::class,["label"=>"Categorie", "choices" => [
                "batiment" => "batiment",
                "tertiaire"=> "tertiaire",
                "Agroalimentaire"=> "Agroalimentaire",
                "Commerce/Distribution"=> "Commerce/Distribution",
            ]])
            ->add('compagny', EntityType::class, ["label" => "compagny","class"=>Compagny::class])
            
            ->add('text', CKEditorType::class,["label"=>"Description de l'annonce", "required" => false])
            ->add('title', TextType::class, ["label" => "Titre", "required" => false, "attr"=>["maxlength" =>65],"constraints" =>[new Length(["max"=>65,"maxMessage"=>"Votre titre doit avoir 65 carractères maximum"])]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
