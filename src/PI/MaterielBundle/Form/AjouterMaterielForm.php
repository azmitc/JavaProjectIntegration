<?php

namespace PI\MaterielBundle\Form;

use MyApp\UserBundle\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;


class AjouterMaterielForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('type' ,ChoiceType::class, array('label'=>'Type : ',
            'choices'  => array(
                'Type de sac a dos' => 'Sac a Dos',
                'Type de tentes' => 'Tentes',
                'Type de vetements' => 'Vetements',
                'Type de couchage' => 'Couchage')
        ,'attr'=>array( "class"=>"form-control")))




            ->add("nom",TextType::class,array('label'=>'Nom : ',
                'attr'=>array( 'placeholder' => 'Le nom de votre materiel',"class"=>"form-control")))
            ->add("reference",TextType::class,array('label'=>'Reference : ',
                'attr'=>array('placeholder' => 'La reference de votre materiel', "class"=>"form-control")))
            ->add("description",TextareaType::class,array('label'=>'description : ',
                'attr'=>array('placeholder' => 'La description de votre materiel', "class"=>"form-control")))
            ->add("prix",NumberType::class,array('label'=>'prix : ',
                'attr'=>array( 'placeholder' => 'Le prix en dt de votre materiel',"class"=>"form-control")))
            ->add("quantite",NumberType::class,array('label'=>'Quantite : ',
                'attr'=>array('placeholder' => 'La quantite de votre materiel', "class"=>"form-control")))
            ->add('imageFile', VichImageType::class, [
                       'required' => false,
                       'allow_delete' => true, // not mandatory, default is true
                       'download_link' => true, // not mandatory, default is true
                       "attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" ),"label"=>false
                   ])
            ->add("Ajouter",SubmitType::class,array(
                'attr'=>array( "class"=>"form-control")));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pimateriel_bundle_ajouter_materiel_form';
    }
}
