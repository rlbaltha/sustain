<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file', array('label'  => 'File to Upload', 'attr' => array('class' => '')))
            ->add('name','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of your file'),))
            ->add('access', 'choice', array('choices'   => array('0' => 'Private', '1' => 'Shared'),'required'  => true, 'expanded'=>true,'multiple'=>false,'label'  => 'Sharing', 'expanded' => true,'attr' => array('class' => 'radio'),))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\File'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_file';
    }
}
