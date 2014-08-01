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
            ->add('name')
            ->add('miImage')
            ->add('dateFormation')
            ->add('heureFormation')
            ->add('dateCreated')
            ->add('adresse')
            ->add('ville')
            ->add('cp')
            ->add('duree')
            ->add('descriptif')
            ->add('nbTotal')
            ->add('isActive')
            ->add('cancelDate')
            ->add('filename')
            ->add('tag')
            ->add('category')
            ->add('inscriptionForms')
            ->add('creator')
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
