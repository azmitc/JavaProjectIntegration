<?php

namespace PI\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheSujetForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('titre',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("attr"=>array("style"=>"margin-top:8px")))
            ->add('theme',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("attr"=>array("style"=>"margin-top:8px")))
            ->add('Rechercher',SubmitType::class,array("attr"=>array("style"=>"margin-top:8px",  "class"=>"ace-icon fa fa-search nav-search-icon")));


    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piforum_bundle_recherche_sujet_form';
    }
}
