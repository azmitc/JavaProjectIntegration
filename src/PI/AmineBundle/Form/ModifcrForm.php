<?php

namespace PI\AmineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifcrForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('label'=>"Nom","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('Description',TextType::class,array('label'=>"Description","attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))
            ->add('Modifier',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piamine_bundle_modifcr_form';
    }
}
