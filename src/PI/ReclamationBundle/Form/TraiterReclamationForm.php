<?php

namespace PI\ReclamationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TraiterReclamationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type' ,TextType::class, array('label'=>'Type : '
        ,'attr'=>array( "class"=>"form-control"),"disabled"=>true))
            ->add('Randonneur',EntityType::class,array('class'=>'MyApp\UserBundle\Entity\User','choice_label'=>'username',"disabled"=>true))

            ->add('Randonnee',EntityType::class,array('class'=>'MyApp\UserBundle\Entity\Randonnee','choice_label'=>'description',"disabled"=>true))

            ->add("dateEnvoi",TextType::class,array('label'=>'Envoyé le :  ',
                'attr'=>array( "class"=>"form-control"),"disabled"=>true))
            ->add("etat",TextType::class,array('label'=>'Etat de Reclamation : ',
                'attr'=>array( "class"=>"form-control"),"disabled"=>true))
            ->add("description",TextareaType::class,array('label'=>'Contenu : ',
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
        return 'pireclamation_bundle_traiter_reclamation_form';
    }
}
