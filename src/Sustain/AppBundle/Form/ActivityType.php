<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Title of your activity'),))
            ->add('description', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('objectives', 'entity', array('class' => 'AppBundle:Objective','property'=>'objective','query_builder' =>
                function(\Sustain\AppBundle\Entity\ObjectiveRepository $er) use ($options) {
                    return $er->createQueryBuilder('o')
                        ->orderBy('o.objective', 'ASC');
                }, 'expanded'=>true,'multiple'=>true, 'label'  => 'Select Objectives', 'attr' => array('class' => 'checkbox'),
            ))
            ->add('tags', 'entity', array('class' => 'AppBundle:Tag','property'=>'name','query_builder' =>
                function(\Sustain\AppBundle\Entity\TagRepository $er) use ($options) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                }, 'expanded'=>true,'multiple'=>true, 'label'  => 'Select Labels', 'attr' => array('class' => 'checkbox'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\Activity'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_activity';
    }
}
