<?php

namespace App\Form;

use App\Entity\Cartes;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CartesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,["help"=>"le titre de la page", "help_attr"=>["class"=>"text-primary"], "label"=>"le titre", "required" => true])
            // ->add('imageName')
            ->add('texte', CKEditorType::class,["label"=>"le texte", "required" => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cartes::class,
        ]);
    }
}
