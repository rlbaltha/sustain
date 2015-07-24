<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start','datetime', array('attr' => array('class' => ''),))
            ->add('end','datetime', array('attr' => array('class' => ''),))
            ->add('title','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Title of your event'),))
            ->add('teaser', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('description', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('color','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Color'),))
            ->add('opportunities', 'entity', array('class' => 'AppBundle:Opportunity',
                'property' => 'title','expanded'=>true,'multiple'=>true,'label'  => 'Related Partners or Opportunities', 'attr' => array('class' =>
                    'checkbox'),))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_event';
    }
}
