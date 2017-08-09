<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Module;
use Sustain\AppBundle\Form\ModuleType;

/**
 * Module controller.
 *
 * @Route("/module")
 */
class ModuleController extends Controller {

  /**
   * Lists all Module entities.
   *
   * @Route("/", name="module")
   * @Method("GET")
   * @Template()
   */
  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('AppBundle:Module')->findAll();
    $categories = $em->getRepository('AppBundle:Category')->findAll();

    return array(
      'entities' => $entities,
      'categories' => $categories,
    );
  }

  /**
   * Lists Modules entities by tag.
   *
   * @Route("/{tag}/modules_by_tag", name="modules_by_tag")
   * @Method("GET")
   * @Template("AppBundle:Module:index.html.twig")
   */
  public function findByTagAction($tag) {
    $em = $this->getDoctrine()->getManager();
    $entities = $em->getRepository('AppBundle:Module')->modulesByTag($tag);
    $categories = $em->getRepository('AppBundle:Category')->findAll();

    return array(
      'entities' => $entities,
      'categories' => $categories,
    );
  }


  /**
   * Creates a new Module entity.
   *
   * @Route("/", name="module_create")
   * @Method("POST")
   * @Template("AppBundle:Shared:new.html.twig")
   */
  public function createAction(Request $request) {
    $entity = new Module();
    $form = $this->createCreateForm($entity);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $user = $this->getUser();
      $entity->setUser($user);
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('module'));
    }

    return array(
      'entity' => $entity,
      'form' => $form->createView(),
    );
  }

  /**
   * Creates a form to create a Module entity.
   *
   * @param Module $entity The entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createCreateForm(Module $entity) {
    $form = $this->createForm(new ModuleType(), $entity, array(
      'action' => $this->generateUrl('module_create'),
      'method' => 'POST',
    ));

    $form->add('submit', 'submit', array(
      'label' => 'Create',
      'attr' => array('class' => 'btn btn-default margin-top')
    ));

    return $form;
  }

  /**
   * Displays a form to create a new Module entity.
   *
   * @Route("/new", name="module_new")
   * @Method("GET")
   * @Template("AppBundle:Shared:new.html.twig")
   */
  public function newAction() {
    $entity = new Module();
    $form = $this->createCreateForm($entity);

    return array(
      'entity' => $entity,
      'form' => $form->createView(),
    );
  }

  /**
   * Finds and displays a Module entity.
   *
   * @Route("/{id}", name="module_show")
   * @Method("GET")
   * @Template()
   */
  public function showAction($id) {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('AppBundle:Module')->find($id);
    $categories = $em->getRepository('AppBundle:Category')->findAll();

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Module entity.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity' => $entity,
      'categories' => $categories,
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Displays a form to edit an existing Module entity.
   *
   * @Route("/{id}/edit", name="module_edit")
   * @Method("GET")
   * @Template("AppBundle:Shared:edit.html.twig")
   */
  public function editAction($id) {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('AppBundle:Module')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Module entity.');
    }

    $editForm = $this->createEditForm($entity);
    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity' => $entity,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Creates a form to edit a Module entity.
   *
   * @param Module $entity The entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createEditForm(Module $entity) {
    $form = $this->createForm(new ModuleType(), $entity, array(
      'action' => $this->generateUrl('module_update', array('id' => $entity->getId())),
      'method' => 'PUT',
    ));

    $form->add('submit', 'submit', array(
      'label' => 'Update',
      'attr' => array('class' => 'btn btn-default margin-top')
    ));


    return $form;
  }

  /**
   * Edits an existing Module entity.
   *
   * @Route("/{id}", name="module_update")
   * @Method("PUT")
   * @Template("AppBundle:Shared:edit.html.twig")
   */
  public function updateAction(Request $request, $id) {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('AppBundle:Module')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Module entity.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createEditForm($entity);
    $editForm->handleRequest($request);

    if ($editForm->isValid()) {
      $em->flush();

      return $this->redirect($this->generateUrl('module'));
    }

    return array(
      'entity' => $entity,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Deletes a Module entity.
   *
   * @Route("/{id}", name="module_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, $id) {
    $form = $this->createDeleteForm($id);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('AppBundle:Module')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Module entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('module'));
  }

  /**
   * Creates a form to delete a Module entity by id.
   *
   * @param mixed $id The entity id
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm($id) {
    return $this->createFormBuilder()
      ->setAction($this->generateUrl('module_delete', array('id' => $id)))
      ->setMethod('DELETE')
      ->add('submit', 'submit', array(
        'label' => 'Delete',
        'attr' => array('class' => 'btn btn-danger'),
      ))
      ->getForm();
  }
}
