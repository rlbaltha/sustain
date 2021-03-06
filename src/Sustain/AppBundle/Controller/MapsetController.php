<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Mapset;
use Sustain\AppBundle\Form\MapsetType;

/**
 * Mapset controller.
 *
 * @Route("/mapset")
 */
class MapsetController extends Controller
{

    /**
     * Lists all Mapset entities.
     *
     * @Route("/", name="mapset")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Mapset')->findAll();
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        return array(
            'entities' => $entities,
            'tags' => $tags,
        );
    }
    /**
     * Creates a new Mapset entity.
     *
     * @Route("/", name="mapset_create")
     * @Method("POST")
     * @Template("AppBundle:Mapset:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mapset();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mapset_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Mapset entity.
     *
     * @param Mapset $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Mapset $entity)
    {
        $form = $this->createForm(new MapsetType(), $entity, array(
            'action' => $this->generateUrl('mapset_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }

    /**
     * Displays a form to create a new Mapset entity.
     *
     * @Route("/new", name="mapset_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mapset();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mapset entity.
     *
     * @Route("/{id}", name="mapset_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mapset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mapset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mapset entity.
     *
     * @Route("/{id}/edit", name="mapset_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mapset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mapset entity.');
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
    * Creates a form to edit a Mapset entity.
    *
    * @param Mapset $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mapset $entity)
    {
        $form = $this->createForm(new MapsetType(), $entity, array(
            'action' => $this->generateUrl('mapset_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }
    /**
     * Edits an existing Mapset entity.
     *
     * @Route("/{id}", name="mapset_update")
     * @Method("PUT")
     * @Template("AppBundle:Mapset:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mapset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mapset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('mapset_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mapset entity.
     *
     * @Route("/{id}", name="mapset_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Mapset')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mapset entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mapset'));
    }

    /**
     * Creates a form to delete a Mapset entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mapset_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
