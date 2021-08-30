<?php

namespace PI\ForumBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

             $builder ->add('note', RatingType::class, [
                 'label' => 'Rating'
             ])
                 ->add("Ajouter",SubmitType::class,array(
                     'attr'=>array( "class"=>"form-control")));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piforum_bundle_note_form';
    }
}
