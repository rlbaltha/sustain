<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ObjectiveType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objective','textarea', array('attr' => array('class' => 'text form-control'),))
            ->add('description', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('tags', 'entity', array('class' => 'AppBundle:Tag','property'=>'name','query_builder' =>
                function(\Sustain\AppBundle\Entity\TagRepository $er) use ($options) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                }, 'expanded'=>true,'multiple'=>true, 'label'  => 'Select Labels', 'attr' => array('class' => 'checkbox'),
            ))
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
            'data_class' => 'Sustain\AppBundle\Entity\Objective'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_objective';
    }
}
