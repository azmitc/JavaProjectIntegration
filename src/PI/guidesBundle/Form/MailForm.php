<?php

namespace PI\guidesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('placeholder' => 'Votre Nom',"class"=>"form-control")
            ))
            ->add('subject', TextType::class, array('attr' => array('placeholder' => 'Sujet',"class"=>"form-control")
            ))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'Votre adresse email',"class"=>"form-control")
            ))
            ->add('message', TextareaType::class, array('attr' => array('placeholder' => 'Votre mesage',"class"=>"form-control")
            ))
        ;

    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    public function getName()
    {
        return 'contact_form';
    }
}
