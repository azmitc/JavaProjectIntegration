<?php

namespace PI\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ModifSujetForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('titre', TextType::class, array("attr" => array("style" => "margin-top:8px", "class"
        => " form-control")))
            ->add('theme', TextType::class, array("attr" => array("style" => "margin-top:8px", "class" =>
                " form-control")))
            ->add('text', TextType::class,
                array("attr" => array("style" => "margin-top:8px", "class" => " form-control")))

            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                "attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control"),"label"=>false
            ])

            ->setMethod('POST')->add('Valider', SubmitType::class, array("attr" => array("style" => "margin-top:8px", "class" => " btn btn-primary")));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piforum_bundle_modif_sujet_form';
    }
}
