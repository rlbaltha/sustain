<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of your module'),))
            ->add('sortorder','number', array('attr' => array('class' => 'form-control')))
            ->add('description', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('theme', 'entity', array('class' => 'AppBundle:Theme',
                'property' => 'name','expanded'=>false,'multiple'=>false,'label'  => 'Theme', 'attr' => array('class' => 'form-control'),))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\Module'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_module';
    }
}
