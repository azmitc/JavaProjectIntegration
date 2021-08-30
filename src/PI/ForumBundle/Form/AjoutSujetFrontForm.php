<?php

namespace PI\ForumBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AjoutSujetFrontForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('titre', TextType::class, array("attr" => array('placeholder' => 'Entrez le Titre du Sujet',"style" => "margin-top:8px", "class" =>
            " form-control")))
            ->add("theme",ChoiceType::class,array("choices"=>array(
                "Discussion"=>"Discussion",
                "Partage Souvenir"=>"Partage Souvenir"),"attr"=>array("class" =>
                " form-control"
            )))


            ->add('text', TextType::class, array("attr" => array('placeholder' => 'Entrez la Description du Sujet',"style" => "margin-top:8px", "class" =>
                " form-control")))

            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                "attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control"),"label"=>false
            ])
            ->add("Ajouter",SubmitType::class,array(
                'attr'=>array( "class"=>"form-control")));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piforum_bundle_ajout_sujet_front_form';
    }
}
