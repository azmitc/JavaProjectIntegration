<?php

namespace PI\MaterielBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutReclamationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description' ,TextAreaType::class, array('label'=>'Description : '
        ,'attr'=>array('placeholder' => 'Description de la reclamation', "class"=>"form-control"),"disabled"=>false))

            ->add('typereclamation' ,ChoiceType::class, array('label'=>'Type de reclamation  : ',
                'choices'  => array(
                    'Défaut de construction' => 'Défaut de construction',
                    'Insatisfait' => 'Insatisfait ',
                    'Erreur'=>'Erreur'

                )
            ,'attr'=>array( "class"=>"form-control")))



            ->add('refmateriel',EntityType::class,array('label'=>'Nom du materiel : ',
                'class'=>'MyApp\UserBundle\Entity\Materiel',
                'choice_label'=>'nom','attr'=>array( "class"=>"form-control")))

            ->add('dateAchat',DateType::class,array("attr"=>array("class"=>"form-control")))


            ->add("Envoyer",SubmitType::class,array(
                'attr'=>array( "class"=>"form-control")))
            ->setMethod("GET");
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pimateriel_bundle_ajout_reclamation_form';
    }
}
