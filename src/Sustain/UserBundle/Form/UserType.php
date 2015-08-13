<?php

namespace Sustain\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname', 'text', array('label'=> 'First name','attr' => array('class' => 'form-control')))
            ->add('lastname', 'text', array('label'=> 'Last name','attr' => array('class' => 'form-control')))
            ->add('role', 'choice', array('choices'  => array('0' => 'Student', '1' => 'Staff', '2' => 'Faculty'),'required' => true,
                'expanded' => true, 'label'  =>
                'Position at UGA','attr' => array
            ('class' => 'radio')))
            ->add('college', 'text', array('required' => false,'label'=> 'School/College','attr' => array('class' => 'form-control')))
            ->add('photo', 'text', array('required' => false,'label'=> 'Photo URL','attr' => array('class' => 'form-control')))
            ->add('bio', 'ckeditor', array('required' => false,'label'=> 'Bio','config_name' => 'editor_simple',))
            ->add('research', 'ckeditor', array('required' => false,'label'=> 'Research interests','config_name' => 'editor_simple',))
            ->add('involvement', 'ckeditor', array('required' => false,'label'=> 'Involvement in WatershedUGA','config_name' => 'editor_simple',))
            ->add('mentor', 'choice', array('choices'   => array('0' => 'Yes', '1' => 'No'),'required'  => true,'label'  => 'I am willing to mentor
            Curo students','expanded' => true,'attr' => array('class' => 'radio'),))
            ->add('public', 'choice', array('choices'   => array('0' => 'Yes', '1' => 'No'),'required'  => true,'label'  => 'I am willing for my profile to be public.','expanded' => true,'attr' => array('class' => 'radio'),))


        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_userbundle_user';
    }
}
