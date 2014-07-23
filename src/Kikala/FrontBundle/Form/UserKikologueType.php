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
            ->add('pseudo')
            ->add('email')
            ->add('password')
            ->add('name')
            ->add('prenom')
            ->add('birthday')
            ->add('gender')
            ->add('metier')
            ->add('infoFormateur')
            ->add('infoEtudiant')
            ->add('photo')
            ->add('token')
            ->add('salt')
            ->add('isActive')
            ->add('dateRegistered')
            ->add('kikos')
            ->add('redCross')
            ->add('image')
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
