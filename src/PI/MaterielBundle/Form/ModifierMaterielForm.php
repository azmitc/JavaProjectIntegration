<?php

namespace PI\MaterielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ModifierMaterielForm extends AbstractType
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
                'attr'=>array( "class"=>"form-control")))
            ->add("reference",TextType::class,array('label'=>'Reference : ',
                'attr'=>array( "class"=>"form-control"),"disabled"=>true))
            ->add("description",TextareaType::class,array('label'=>'description : ',
                'attr'=>array( "class"=>"form-control")))
            ->add("prix",NumberType::class,array('label'=>'prix : ',
                'attr'=>array( "class"=>"form-control")))
            ->add("quantite",NumberType::class,array('label'=>'Quantite : ',
                'attr'=>array( "class"=>"form-control")))


            ->add("Modifier",SubmitType::class,array(
                'attr'=>array( "class"=>"form-control")))
            ->setMethod("GET");

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pimateriel_bundle_modifier_materiel_form';
    }
}
