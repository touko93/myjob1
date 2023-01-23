<?php

namespace App\Form;

use App\Entity\Compagny;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CompagnyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,["label"=>"Nom","required"=> true])
            ->add('adres',TextType::class,["label"=>"Adresse","required"=> true])
            ->add('email',TextType::class,["label"=>"Email","required"=> true])
            ->add('phone',TextType::class,["label"=>"Telephone","required"=> true])
            ->add('imageFile',FileType::class,["label" =>"Annonce", "required" => true])
            ->remove('updatedAt',DateTimeType::class,["widget"=>"single_text"])
            ->remove('slug')
            ->add('tag', ChoiceType::class,["label"=>"Categorie", "choices" => [
                "batiment" => "batiment",
                "tertiaire"=> "tertiaire",
                "Agroalimentaire"=> "Agroalimentaire",
                "Commerce/Distribution"=> "Commerce/Distribution",
            ]])
            ->remove('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compagny::class,
        ]);
    }
}
