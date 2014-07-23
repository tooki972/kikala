<?php

namespace Kikala\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserKikologueType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', null, array(
                'required' => false,
                "label" => "Pseudo",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-2"
                ),
                'attr' => array(
                 'placeholder' => 'Pseudo',
                 'class'=> "col-xs-12 col-md-10"
                ) ))
            ->add('email', 'email',
                array(
                'required' => false,
                "label" => "email",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-2"
                ),
                'attr' => array(
                 'placeholder' => 'email',
                 'class'=> "col-xs-12 col-md-10"
                ) ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password',
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-2"
                )),
                'second_options' => array('label' => 'Confirmez votre password',
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-2"
                )),
                ))
            ->add('name', null, array(
                'required' => false,
                "label" => "name",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-2"
                ),
                'attr' => array(
                 'placeholder' => 'name',
                 'class'=> "col-xs-12 col-md-10"
                )  
                ))
            ->add('prenom', null, array(
                'required' => false,
                "label" => "prenom",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-2"
                ),
                'attr' => array(
                 'placeholder' => 'prenom',
                 'class'=> "col-xs-12 col-md-10"
                )  
                ))
            ->add('birthday', 'datetime', array(
                "label" => "Date de création",
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy',
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-2"
                ),
                ))
            ->add('gender', 'choice', array(
                'choices' => array(
                    'm' => 'Masculin',
                    'f' => 'Féminin'
                ),
                'required'    => false,
                'empty_value' => 'Choisissez votre sexe',
                'empty_data'  => null
                 ))
            ->add('metier', 'text')
            ->add('infoFormateur', 'textarea')
            ->add('infoEtudiant', 'textarea')
            ->add('photo', 'textarea')
            //->add('token')
            //->add('salt')
            //->add('isActive')
            //->add('dateRegistered')
            ->add('kikos', 'text')
            ->add('redCross', 'text')
            ->add('image', 'textarea')
            ->add('Valider', 'submit', array(
                'attr'=> array(
                'class'=>'btn btn-primary btn-xs col-xs-12 col-md-10 col-md-offset-2')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kikala\FrontBundle\Entity\UserKikologue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kikala_frontbundle_userkikologue';
    }
}
