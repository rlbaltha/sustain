<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Sample;
use Sustain\AppBundle\Form\SampleType;

/**
 * Sample controller.
 *
 * @Route("/sample")
 */
class SampleController extends Controller
{

    /**
     * Lists all Sample entities.
     *
     * @Route("/", name="sample")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $entities = $em->getRepository('AppBundle:Sample')->findAll();

        return array(
            'entities' => $entities,
            'user' => $user,
        );
    }
    /**
     * Creates a new Sample entity.
     *
     * @Route("/", name="sample_create")
     * @Method("POST")
     * @Template("AppBundle:Sample:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sample();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $user = $this->getUser();
            $entity->setUser($user);
            $em->flush();

            return $this->redirect($this->generateUrl('sample_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Sample entity.
     *
     * @param Sample $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sample $entity)
    {
        $form = $this->createForm(new SampleType(), $entity, array(
            'action' => $this->generateUrl('sample_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sample entity.
     *
     * @Route("/new", name="sample_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sample();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sample entity.
     *
     * @Route("/{id}", name="sample_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sample')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sample entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sample entity.
     *
     * @Route("/{id}/edit", name="sample_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sample')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sample entity.');
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
    * Creates a form to edit a Sample entity.
    *
    * @param Sample $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sample $entity)
    {
        $form = $this->createForm(new SampleType(), $entity, array(
            'action' => $this->generateUrl('sample_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sample entity.
     *
     * @Route("/{id}", name="sample_update")
     * @Method("PUT")
     * @Template("AppBundle:Sample:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sample')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sample entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sample_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sample entity.
     *
     * @Route("/{id}", name="sample_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Sample')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sample entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sample'));
    }

    /**
     * Creates a form to delete a Sample entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sample_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
