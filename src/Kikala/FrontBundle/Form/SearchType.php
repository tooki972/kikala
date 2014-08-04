<?php

namespace Kikala\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'required' => false,
                "label" => "Recherche",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'Recherche',
                 'class'=> "col-xs-12 col-md-8 form-control",
                 'name'=>'name'
                )  ,
                ))
         

            ->add('category', 'entity', array(
                'property'=>'name',
                'class'=>'Kikala\FrontBundle\Entity\Category',
                'required' => false,
                "label" => "Catégorie",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'category',
                 'data' => 'category',
                 'class'=> "col-xs-12 col-md-8 form-control",
                 'name'=>'category'
                )  
                ))
               ->add('tag', 'entity', array(
                'property'=>'name',
                'class'=>'Kikala\FrontBundle\Entity\Tag',
                'required' => false,
                "label" => "Tag",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'Tag',
                 'data' => 'Tag',
                 'class'=> "col-xs-12 col-md-8 form-control",
                 'name'=>'tag'
                )  ,
                ))
  ->add('Valider', 'submit', array(
                'attr'=> array(
                'class'=>'btn btn-primary btn-xs col-xs-12 col-md-8 col-md-offset-4'
                 )))
        ;
        
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kikala\FrontBundle\Entity\Formation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kikala_frontbundle_formation';
    }
}
