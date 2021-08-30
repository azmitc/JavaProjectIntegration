<?php

namespace PI\MaterielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TraiterReclamation extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description' ,TextType::class, array('label'=>'Description : '
        ,'attr'=>array( "class"=>"form-control"),"disabled"=>true))
            ->add("typereclamation",TextType::class,array('label'=>'Type reclamation : ',
                'attr'=>array( "class"=>"form-control"),"disabled"=>true))
            ->add("dateAchat",DateType::class,array('widget'=>'single_text','label'=>'Date Achat :  ',
                'attr'=>array( "class"=>"form-control"),"disabled"=>true))
            ->add("dateEnvoi",DateType::class,array('widget'=>'single_text','label'=>'Envoyé le :  ',
                'attr'=>array( "class"=>"form-control"),"disabled"=>true))

            ->add("reponse",TextareaType::class,array('label'=>'Reponse : ',
                'attr'=>array( "class"=>"form-control")))
            ->add("Envoyer",SubmitType::class,array(
                'attr'=>array( "class"=>"form-control")))
            ->setMethod("GET");

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pimateriel_bundle_traiter_reclamation';
    }
}
