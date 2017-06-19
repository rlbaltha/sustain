<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SectionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of the Section'),))
            ->add('image','text', array('attr' => array('class' => 'text form-control'),))
            ->add('info', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('image','text', array('attr' => array('class' => 'text form-control'),))
            ->add('display', 'choice', array('choices'   => array(true => 'Yes', false => 'No'),'required'  => true,
             'label'  => 'Display in menu:',
            'expanded' => true,'attr' => array('class' => 'radio'),))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\Section'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_section';
    }
}
