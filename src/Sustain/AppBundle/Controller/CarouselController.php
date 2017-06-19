<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Carousel;
use Sustain\AppBundle\Form\CarouselType;

/**
 * Carousel controller.
 *
 * @Route("/carousel")
 */
class CarouselController extends Controller
{

    /**
     * Lists all Carousel entities.
     *
     * @Route("/", name="carousel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Carousel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Carousel entity.
     *
     * @Route("/", name="carousel_create")
     * @Method("POST")
     * @Template("AppBundle:Carousel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Carousel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carousel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Carousel entity.
     *
     * @param Carousel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Carousel $entity)
    {
        $form = $this->createForm(new CarouselType(), $entity, array(
            'action' => $this->generateUrl('carousel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Carousel entity.
     *
     * @Route("/new", name="carousel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Carousel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Carousel entity.
     *
     * @Route("/{id}", name="carousel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Carousel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carousel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Carousel entity.
     *
     * @Route("/{id}/edit", name="carousel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Carousel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carousel entity.');
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
    * Creates a form to edit a Carousel entity.
    *
    * @param Carousel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Carousel $entity)
    {
        $form = $this->createForm(new CarouselType(), $entity, array(
            'action' => $this->generateUrl('carousel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Carousel entity.
     *
     * @Route("/{id}", name="carousel_update")
     * @Method("PUT")
     * @Template("AppBundle:Carousel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Carousel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carousel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('carousel_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Carousel entity.
     *
     * @Route("/{id}", name="carousel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Carousel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Carousel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('carousel'));
    }

    /**
     * Creates a form to delete a Carousel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carousel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
