<?php

namespace Kikala\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'required' => true,
                "label" => "Tag",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'nom du tag',
                 'class'=> "col-xs-12 col-md-8",
                 'id'=>'tag',
                )  
                ))
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
            'data_class' => 'Kikala\FrontBundle\Entity\Tag'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kikala_frontbundle_tag';
    }
}
