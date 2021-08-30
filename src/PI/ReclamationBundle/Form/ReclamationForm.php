<?php

namespace PI\ReclamationBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type' ,ChoiceType::class, array('label'=>'Type : ',
            'choices'  => array(
                'Rèclamation de vol' => 'Vol',
                'Rèclamation de perte' => 'Perte',
                'Rèclamation dans le logement' => 'logement',
                'Problème avec un guide' => 'problème avec un guide',
                'Problème avec un randonneur' => 'problème avec un randonneur',
                'Autre' => 'Autre')
        ,'attr'=>array( "class"=>"form-control")))

            ->add('Randonnee',EntityType::class,array('label'=>'Randonnée : ','class'=>'MyApp\UserBundle\Entity\Randonnee','choice_label'=>'description'))

            ->add("description",TextareaType::class,array('label'=>'Contenu : ','required' => true,
                'attr'=>array( "class"=>"form-control",'placeholder' => 'le contenu de votre rèclamation')))

            ->add("Envoyer",SubmitType::class,array(
                'attr'=>array( "class"=>"btn btn-success")))
            ->setMethod("GET");
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pireclamation_bundle_reclamation_form';
    }
}
