<?php

namespace PI\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AjoutCommentaireForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text',TextareaType::class, array('attr' => array('placeholder' => 'Entrez votre Commentaire',"class"=>"form-control")
            ))
            ->add('commenter',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piforum_bundle_ajout_commentaire_form';
    }
}
