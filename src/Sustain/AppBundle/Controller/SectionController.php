<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Section;
use Sustain\AppBundle\Form\SectionType;

/**
 * Section controller.
 *
 * @Route("/section")
 */
class SectionController extends Controller
{

    /**
     * Lists all Section entities.
     *
     * @Route("/", name="section")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $new_entities = $em->getRepository('AppBundle:Page')->findNewStories();

        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $entities = $em->getRepository('AppBundle:Section')->findAll();
        }
        else {
            $entities = $em->getRepository('AppBundle:Section')->findSorted();
        }

        return array(
            'new_entities' => $new_entities,
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Section entity.
     *
     * @Route("/", name="section_create")
     * @Method("POST")
     * @Template("AppBundle:Shared:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Section();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('section'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Section entity.
     *
     * @param Section $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Section $entity)
    {
        $form = $this->createForm(new SectionType(), $entity, array(
            'action' => $this->generateUrl('section_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }

    /**
     * Displays a form to create a new Section entity.
     *
     * @Route("/new", name="section_new")
     * @Method("GET")
     * @Template("AppBundle:Shared:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Section();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Section entity.
     *
     * @Route("/{id}/", name="section_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Section')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Section entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Section entity.
     *
     * @Route("/{id}/edit", name="section_edit")
     * @Method("GET")
     * @Template("AppBundle:Shared:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Section')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Section entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Section entity.
    *
    * @param Section $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Section $entity)
    {
        $form = $this->createForm(new SectionType(), $entity, array(
            'action' => $this->generateUrl('section_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }
    /**
     * Edits an existing Section entity.
     *
     * @Route("/{id}", name="section_update")
     * @Method("PUT")
     * @Template("AppBundle:Shared:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Section')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Section entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('section'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Section entity.
     *
     * @Route("/{id}", name="section_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Section')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Section entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('section'));
    }

    /**
     * Creates a form to delete a Section entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('section_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
