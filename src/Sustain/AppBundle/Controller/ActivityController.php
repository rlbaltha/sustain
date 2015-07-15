<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Activity;
use Sustain\AppBundle\Form\ActivityType;

/**
 * Activity controller.
 *
 * @Route("/activity")
 */
class ActivityController extends Controller
{

    /**
     * Lists all Activity entities.
     *
     * @Route("/", name="activity")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Activity')->findAll();
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        return array(
            'entities' => $entities,
            'tags' => $tags,
        );
    }

    /**
     * Lists Modules entities by tag.
     *
     * @Route("/{tag}/activity_by_tag", name="activity_by_tag")
     * @Method("GET")
     * @Template("AppBundle:Activity:index.html.twig")
     */
    public function findByTagAction($tag)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Activity')->activitiesByTag($tag);
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        return array(
            'entities' => $entities,
            'tags' => $tags,
        );
    }


    /**
     * Creates a new Activity entity.
     *
     * @Route("/", name="activity_create")
     * @Method("POST")
     * @Template("AppBundle:Activity:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Activity();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('activity'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Activity entity.
     *
     * @param Activity $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Activity $entity)
    {
        $form = $this->createForm(new ActivityType(), $entity, array(
            'action' => $this->generateUrl('activity_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }

    /**
     * Displays a form to create a new Activity entity.
     *
     * @Route("/new", name="activity_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Activity();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Activity entity.
     *
     * @Route("/{id}", name="activity_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Activity')->find($id);
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'tags' => $tags,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Activity entity.
     *
     * @Route("/{id}/edit", name="activity_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
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
    * Creates a form to edit a Activity entity.
    *
    * @param Activity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Activity $entity)
    {
        $form = $this->createForm(new ActivityType(), $entity, array(
            'action' => $this->generateUrl('activity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }
    /**
     * Edits an existing Activity entity.
     *
     * @Route("/{id}", name="activity_update")
     * @Method("PUT")
     * @Template("AppBundle:Activity:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('activity'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Activity entity.
     *
     * @Route("/{id}", name="activity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Activity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Activity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('activity'));
    }

    /**
     * Creates a form to delete a Activity entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('activity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
