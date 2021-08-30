<?php

namespace PI\guidesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class)

            ->add('prenom')
            ->add('numTel')
            ->add('cin')
            ->add('email')
            ->add('userName')
            ->add('roles', ChoiceType::class, array('label' =>'Type ',
                'choices' =>array(' AGENCE' =>'ROLE_AGENCE',
                    'Randonneur' =>'ROLE_RANDONNEUR',
                    'Guide'=>'ROLE_GUIDE',
                    'Admin'=>'ROLE_ADMIN'),
                'required' =>true, 'multiple' =>true,))
            ->add('disponibilite')
            ->add('competance')
        ->add("Ajouter",SubmitType::class,array(
            'attr'=>array( "class"=>"form-control")))
            ->setMethod('GET');


    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piguides_bundle_ajout_form';
    }
}
