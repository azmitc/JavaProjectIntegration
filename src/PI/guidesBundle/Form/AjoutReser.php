<?php

namespace PI\guidesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutReser extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {$builder->add('nombreplace',NumberType::class,array('label'=>"Nombre de Place",'required'=>true,"attr"=>array("style"=>"margin-bottom:10px","class"=>"form-control" )))

        ->add('Reserver',SubmitType::class);


    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piguides_bundle_ajout_reser';
    }
}
