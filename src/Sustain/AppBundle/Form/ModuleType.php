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
            ->add('description', 'ckeditor', array('config_name' => 'editor_default',))
            ->add('tags', 'entity', array('class' => 'AppBundle:Tag','property'=>'name','query_builder' =>
                function(\Sustain\AppBundle\Entity\TagRepository $er) use ($options) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                }, 'expanded'=>true,'multiple'=>true, 'label'  => 'Select Labels', 'attr' => array('class' => 'checkbox'),
            ))
            ->add('objectives', 'entity', array('class' => 'AppBundle:Objective',
                'property' => 'objective','expanded'=>true,'multiple'=>true,'label'  => 'Objectives', 'attr' => array('class' => 'checkbox'),))
            ->add('mapsets', 'entity', array('class' => 'AppBundle:Mapset',
                'property' => 'name','expanded'=>true,'multiple'=>true,'label'  => 'Maps', 'attr' => array('class' => 'checkbox'),))
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
