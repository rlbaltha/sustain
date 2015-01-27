<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MapType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of the map point'),))
            ->add('lat','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of the map point'),))
            ->add('lng','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of the map point'),))
            ->add('description','textarea', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of the map point'),))
            ->add('map','number', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of the map point'),))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\Map'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_map';
    }
}
