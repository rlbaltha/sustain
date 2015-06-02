<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sustain\AppBundle\Entity\Objective;
use Sustain\AppBundle\Form\ObjectiveType;

/**
 * Objective controller.
 *
 * @Route("/objective")
 */
class ObjectiveController extends Controller
{

    /**
     * Lists all Objective entities.
     *
     * @Route("/", name="objective")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Objective')->findAll();
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        return array(
            'entities' => $entities,
            'tags' => $tags,
        );
    }


    /**
     * Lists Modules entities by tag.
     *
     * @Route("/{tag}/objectives_by_tag", name="objectives_by_tag")
     * @Method("GET")
     * @Template("AppBundle:Objective:index.html.twig")
     */
    public function findByTagAction($tag)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Objective')->objectivesByTag($tag);
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        return array(
            'entities' => $entities,
            'tags' => $tags,
        );
    }


    /**
     * Creates a new Objective entity.
     *
     * @Route("/", name="objective_create")
     * @Method("POST")
     * @Template("AppBundle:Objective:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Objective();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('objective'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Objective entity.
     *
     * @param Objective $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Objective $entity)
    {
        $form = $this->createForm(new ObjectiveType(), $entity, array(
            'action' => $this->generateUrl('objective_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Objective entity.
     *
     * @Route("/new", name="objective_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Objective();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Objective entity.
     *
     * @Route("/{id}", name="objective_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Objective')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Objective entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Objective entity.
     *
     * @Route("/{id}/edit", name="objective_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Objective')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Objective entity.');
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
    * Creates a form to edit a Objective entity.
    *
    * @param Objective $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Objective $entity)
    {
        $form = $this->createForm(new ObjectiveType(), $entity, array(
            'action' => $this->generateUrl('objective_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Objective entity.
     *
     * @Route("/{id}", name="objective_update")
     * @Method("PUT")
     * @Template("AppBundle:Objective:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Objective')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Objective entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('objective_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Objective entity.
     *
     * @Route("/{id}", name="objective_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Objective')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Objective entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('objective'));
    }

    /**
     * Creates a form to delete a Objective entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('objective_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
