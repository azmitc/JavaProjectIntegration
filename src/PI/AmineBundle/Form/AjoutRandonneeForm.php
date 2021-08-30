<?php

namespace PI\AmineBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AjoutRandonneeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imageFile', VichImageType::class, [
            'required' => true,
            'allow_delete' => true, // not mandatory, default is true
            'download_link' => true, // not mandatory, default is true
            "label"=>false
        ])


            ->add('categorie', EntityType::class,array("label"=>"Categorie de la randonnée",
            'class'=>'MyApp\UserBundle\Entity\Categorierandonnee',
            'choice_label'=>'nom',"attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))


            ->add('lieu',TextType::class,array('label'=>"Lieu","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))

            ->add('dateDebut',DateType::class,array('label'=>"Date de la Randonnée",'data' => new \DateTime("now")))
            ->add('dateFin',DateType::class,array('label'=>"Date de fin de la Randonnée",'data' => new \DateTime("now")))
            ->add('heureDepart',TimeType::class,array('label'=>"Heure de départ"))
            ->add('heureRetour',TimeType::class,array('label'=>"Heure de retour"))
            ->add('prix',NumberType::class,array('label'=>"Prix de la randonnée","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('nbrplace',NumberType::class,array('label'=>"Nombre de Place","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('circuit',TextType::class,array('label'=>"Circuit","required"=>false,"attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('niveau', ChoiceType::class, array('label'=>"Niveau de difficulté",
                'choices' => array('Facile' => 'Facile', 'Moyen' => 'Moyen' , 'Difficile' => 'Difficile'),
                'expanded' => true,
                'multiple' => false
             ))
            ->add('equipments',TextareaType::class,array('label'=>"Les équipements","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('description',TextareaType::class,array('label'=>"Donner plus de détails","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('guidid',TextType::class,array('label'=>"Nom du guide","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('Ajout',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piamine_bundle_ajout_randonnee_form';
    }
}
