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
            ->add('name','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Name of your file'),))
            ->add('description', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('modules', 'entity', array('class' => 'AppBundle:Module','property'=>'name','query_builder' =>
                function(\Sustain\AppBundle\Entity\ModuleRepository $er) use ($options) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.name', 'ASC');
                }, 'expanded'=>true,'multiple'=>true, 'label'  => 'Select Modules', 'attr' => array('class' => 'checkbox'),
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
