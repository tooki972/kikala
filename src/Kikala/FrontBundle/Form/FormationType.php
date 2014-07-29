<?php

namespace Kikala\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormationType extends AbstractType
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
                "label" => "Nom de la formation",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'nom de la formation',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            ->add('miImage', 'file', array(
                'required' => false,
                "label" => "Photo illustrative",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => '',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            ->add('dateFormation', 'datetime', array(
                "label" => "Date de la formation",
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'MM/dd/yyyy',
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                ))
            ->add('heureFormation', 'time', array(
                'input'  => 'datetime',
                'required' => true,
                "label" => "Heure de la formation",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                ))
            //->add('dateCreated')
            ->add('adresse', null, array(
                'required' => true,
                "label" => "Adresse",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'Adresse de la formation',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            ->add('ville', null, array(
                'required' => true,
                "label" => "Ville",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'Ville',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            ->add('cp', null, array(
                'required' => true,
                "label" => "Code postal",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'Code postal',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            ->add('duree', null, array(
                'required' => true,
                "label" => "Durée de la formation (en heure)",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'duree de la formation',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            ->add('descriptif', 'textarea', array(
                'required' => true,
                "label" => "Descriptif",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'descriptif',
                 'class'=> "col-xs-12 col-md-8"
                ) ))
            ->add('nbTotal', null, array(
                'required' => true,
                "label" => "Nombre de place",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'nombre de place totale',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))
            //->add('isActive')
            //->add('cancelDate')
            ->add('tag', 'entity', array(
                'property'=>'name',
                'class'=>'Kikala\FrontBundle\Entity\Tag',
                'required' => true,
                "label" => "Tag",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'Tag',
                 'class'=> "col-xs-12 col-md-8 form-control"
                )  
                ))

            ->add('category', 'entity', array(
                'property'=>'name',
                'class'=>'Kikala\FrontBundle\Entity\Category',
                'required' => true,
                "label" => "Catégorie",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'category',
                 'class'=> "col-xs-12 col-md-8 form-control"
                )  
                ))
            /*->add('inscriptionForms', null, array(
                'required' => true,
                "label" => "inscriptionForms",
                'label_attr' => array(
                 'class'=> "col-xs-12 col-md-4"
                ),
                'attr' => array(
                 'placeholder' => 'nombre d\'inscrit',
                 'class'=> "col-xs-12 col-md-8"
                )  
                ))*/
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
