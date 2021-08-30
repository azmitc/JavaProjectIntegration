<?php

namespace PI\MaterielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AfficherUserReclamtionForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description' ,TextType::class, array('label'=>'Description : '
        ,'attr'=>array( "class"=>"form-control"),"disabled"=>true))

            ->add('typereclamation' ,TextType::class, array('label'=>'Type de reclamation  : '
            ,'attr'=>array( "class"=>"form-control"),"disabled"=>true))


            ->add('dateAchat',DateType::class,array("attr"=>array("class"=>"form-control"),"disabled"=>true))

            ->add("reponse",TextareaType::class,array('label'=>'Reponse : ',
                'attr'=>array( "class"=>"form-control"),"disabled"=>true))
        ;




    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pimateriel_bundle_afficher_user_reclamtion_form';
    }
}
