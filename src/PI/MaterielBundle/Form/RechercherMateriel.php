<?php

namespace PI\MaterielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercherMateriel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('Nom',TextType::class,array("attr"=>array("style"=>"margin-top:8px")))
        ->add('Prix',TextType::class,array("attr"=>array("style"=>"margin-top:8px")))
        ->add('Rechercher',SubmitType::class,array("attr"=>array("style"=>"margin-top:8px", "class"=>" btn btn-primary")))
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'pimateriel_bundle_rechercher_materiel';
    }
}
