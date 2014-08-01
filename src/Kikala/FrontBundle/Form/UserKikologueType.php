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
                'required' => true,
                "label" => "Pseudo",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'Pseudo',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            ->add('email', 'email',
                array(
                'required' => true,
                "label" => "email",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'email',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password',
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                )),
                'second_options' => array('label' => 'Confirmez votre password',
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                )),
                ))
            ->add('name', null, array(
                'required' => true,
                "label" => "name",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'name',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            ->add('prenom', null, array(
                'required' => true,
                "label" => "prenom",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'prenom',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            ->add('birthday', 'datetime', array(
                "label" => "Date de naissance",
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy',
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'jj/mm/yyyy',
                 'class'=> "col-xs-12 col-md-8"
                )
                ))
            ->add('gender', 'choice', array(
                'choices' => array(
                    'm' => 'Masculin',
                    'f' => 'Féminin'
                ),
                'required'    => false,
                'empty_value' => 'Choisissez votre sexe',
                'empty_data'  => null,
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                 ))
            ->add('metier', 'text', array(
                'required' => true,
                "label" => "metier",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'metier',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            ->add('infoFormateur', 'textarea', array(
                'required' => true,
                "label" => "infoFormateur",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'infoFormateur',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            ->add('infoEtudiant', 'textarea', array(
                'required' => true,
                "label" => "infoEtudiant",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'infoEtudiant',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            ->add('photo', 'file', array(
                'required' => false,
                "label" => "photo",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => '',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            //->add('token')
            //->add('salt')
            //->add('isActive')
            //->add('dateRegistered')
            //->add('kikos', 'text')
            //->add('redCross', 'text')
            //->add('image', 'textarea')
            ->add('Valider', 'submit', array(
                'attr'=> array(
                'class'=>'btn btn-primary btn-xs col-xs-12 col-md-8 col-md-offset-4')))
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
