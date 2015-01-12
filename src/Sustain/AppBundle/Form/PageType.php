<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menuName','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Title Page for Menus'),))
            ->add('teaser', 'ckeditor', array('config_name' => 'editor_simple',))
            ->add('teaserImage','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Image for homepage teaser'),))
            ->add('teaserImageCaption','text', array('attr' => array('class' => 'text form-control', 'placeholder' => 'Caption for teaser image'),))
            ->add('pageBody', 'ckeditor', array('config_name' => 'editor_page',))
            ->add('homepage', 'choice', array('choices'   => array(true => 'Yes', false => 'No'),'required'  => true,'label'  => 'Show on homepage:',
                'expanded' => true,'attr' => array('class' => 'radio'),))
            ->add('section', 'entity', array('class' => 'AppBundle:Section',
                'property' => 'name','expanded'=>false,'multiple'=>false,'label'  => 'Section', 'attr' => array('class' => 'form-control'),))
            ->add('parent', 'entity', array('class' => 'AppBundle:Page',
                'property' => 'menuName','expanded'=>false,'multiple'=>false,'label'  => 'Parent page', 'required'=> false,'attr' => array('class' => 'form-control'),))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sustain\AppBundle\Entity\Page'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sustain_appbundle_page';
    }
}
