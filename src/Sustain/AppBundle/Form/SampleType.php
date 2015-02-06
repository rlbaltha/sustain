<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SampleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facility','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of facility'),))
            ->add('sysLoc','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of location'),))
            ->add('param','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Parameter'),))
            ->add('date','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Date'),))
            ->add('paramValue','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Parameter Value'),))
            ->add('paraUnit','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Parameter Unit'),))
            ->add('ebatch','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Data Batch'),))
            ->add('task','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Task'),))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\Sample'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_sample';
    }
}
