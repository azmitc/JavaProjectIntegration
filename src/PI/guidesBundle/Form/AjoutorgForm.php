<?php

namespace PI\guidesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutorgForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class)

            ->add('description')
            ->add('prenom')
            ->add('numTel')
            ->add('cin')
            ->add('mail')
            ->add('userName')
            ->add('pwd')
            ->add('roles', ChoiceType::class, array('label' =>'Type ',
                'choices' =>array(' AGENCE' =>'ROLE_AGENCE',
                    'Randonneur' =>'ROLE_RANDONNEUR',
                    'Guide'=>'ROLE_GUIDE',
                    'Admin'=>'ROLE_ADMIN'),
                'required' =>true, 'multiple' =>true,))
            ->add('birthday',DateType::class)
            ->add('typeorganisateur')
            ->setMethod('GET');

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'piguides_bundle_ajoutorg_form';
    }
}
