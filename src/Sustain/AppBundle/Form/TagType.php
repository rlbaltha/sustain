<?php

namespace Sustain\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType {
  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('name', 'text', array(
        'attr' => array(
          'class' => 'text form-control',
          'placeholder' => 'Name of your label'
        ),
      ))
      ->add('color', 'text', array('attr' => array('class' => 'text form-control'),))
      ->add('category', 'entity', array('class' => 'AppBundle:Category',
        'property' => 'name','expanded'=>false,'multiple'=>false,'label'  =>
          'Category', 'attr' => array('class' => 'form-control'),))
      ->add('sortorder', 'number', array('attr' => array('class' => 'form-control')));
  }

  /**
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setDefaults(array(
      'data_class' => 'Sustain\AppBundle\Entity\Tag'
    ));
  }

  /**
   * @return string
   */
  public function getName() {
    return 'sustain_appbundle_tag';
  }
}
