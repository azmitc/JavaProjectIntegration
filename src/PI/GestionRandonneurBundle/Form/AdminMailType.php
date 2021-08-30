<?php

namespace PI\GestionRandonneurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class AdminMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('subject', TextType::class, array('attr' => array('placeholder' => 'Sujet',"class"=>"form-control")
            ))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'Votre adresse email',"class"=>"form-control")
            ))
            ->add('message', TextareaType::class, array('attr' => array('placeholder' => 'Votre message...',"class"=>"width-100","resize"=>"none")
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pigestion_admin_bundle_admin_mail_type';
    }
}
