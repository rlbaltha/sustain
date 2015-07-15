<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Opportunity;
use Sustain\AppBundle\Form\OpportunityType;

/**
 * Opportunity controller.
 *
 * @Route("/opportunity")
 */
class OpportunityController extends Controller
{

    /**
     * Lists all Opportunity entities.
     *
     * @Route("/{type}/list", name="opportunity", defaults={"type" = "service"})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($type)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Opportunity')->findByType($type);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Opportunity entity.
     *
     * @Route("/", name="opportunity_create")
     * @Method("POST")
     * @Template("AppBundle:Opportunity:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Opportunity();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('opportunity'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Opportunity entity.
     *
     * @param Opportunity $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Opportunity $entity)
    {
        $form = $this->createForm(new OpportunityType(), $entity, array(
            'action' => $this->generateUrl('opportunity_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }

    /**
     * Displays a form to create a new Opportunity entity.
     *
     * @Route("/new", name="opportunity_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Opportunity();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Opportunity entity.
     *
     * @Route("/{id}", name="opportunity_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Opportunity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opportunity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Opportunity entity.
     *
     * @Route("/{id}/edit", name="opportunity_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Opportunity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opportunity entity.');
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
    * Creates a form to edit a Opportunity entity.
    *
    * @param Opportunity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Opportunity $entity)
    {
        $form = $this->createForm(new OpportunityType(), $entity, array(
            'action' => $this->generateUrl('opportunity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }
    /**
     * Edits an existing Opportunity entity.
     *
     * @Route("/{id}", name="opportunity_update")
     * @Method("PUT")
     * @Template("AppBundle:Opportunity:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Opportunity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opportunity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('opportunity'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Opportunity entity.
     *
     * @Route("/{id}", name="opportunity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Opportunity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Opportunity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('opportunity'));
    }

    /**
     * Creates a form to delete a Opportunity entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opportunity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
