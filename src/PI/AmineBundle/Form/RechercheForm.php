<?php

namespace PI\AmineBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class RechercheForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', EntityType::class,array('required'=>false,"label"=>"Categorie de la randonnée",
                'class'=>'MyApp\UserBundle\Entity\Categorierandonnee',
                'choice_label'=>'nom',"attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))


            ->add('lieu',TextType::class,array('required'=>false,'label'=>"Lieu","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))


            ->add('prix',NumberType::class,array('required'=>false,'label'=>"Prix de la randonnée","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('niveau', ChoiceType::class, array('required'=>false,'label'=>"Niveau de difficulté",
                'choices' => array('Facile' => 'Facile', 'Moyen' => 'Moyen' , 'Difficile' => 'Difficile'),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('chercher',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piamine_bundle_recherche_form';
    }
}
