<?php

namespace Sustain\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sustain\AppBundle\Entity\File;
use Sustain\AppBundle\Form\FileType;
use Sustain\AppBundle\Form\UploadType;
use Sustain\AppBundle\Form\LinkType;

/**
 * File controller.
 *
 * @Route("/file")
 */
class FileController extends Controller
{

    /**
     * Lists all File entities.
     *
     * @Route("/", name="file")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $files = $em->getRepository('AppBundle:File')->findAll();
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        return array(
            'files' => $files,
            'tags' => $tags,
        );
    }

    /**
     * Lists all File entities.
     *
     * @Route("/{tag}/files_by_tag", name="files_by_tag")
     * @Method("GET")
     * @Template("AppBundle:File:index.html.twig")
     */
    public function findByTagAction($tag)
    {
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->filesByTag($tag);
        $tags = $em->getRepository('AppBundle:Tag')->sortedTags();

        return array(
            'files' => $files,
            'tags' => $tags,
        );
    }

    /**
     * Creates a new File entity.
     *
     * @Route("/{type}/new", name="file_create", defaults={"type" = "upload"})
     * @Method("POST")
     * @Template("AppBundle:File:new.html.twig")
     */
    public function createAction(Request $request, $type)
    {
        $entity = new File();
        $form = $this->createCreateForm($entity, $type);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('file'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a File entity.
     *
     * @param File $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(File $entity, $type)
    {
        if ($type=='upload') {
            $form = $this->createForm(new UploadType(), $entity, array(
                'action' => $this->generateUrl('file_create'),
                'method' => 'POST',
            ));
        }
        else {
            $form = $this->createForm(new LinkType(), $entity, array(
                'action' => $this->generateUrl('file_create', array('type' => $type)),
                'method' => 'POST',
            ));
        }

        $form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }

    /**
     * Displays a form to create a new File entity.
     *
     * @Route("/{type}/new", name="file_new" , defaults={"type" = "upload"})
     * @Method("GET")
     * @Template()
     */
    public function newAction($type)
    {
        $entity = new File();
        $form   = $this->createCreateForm($entity, $type);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a File entity.
     *
     * @Route("/{id}", name="file_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Finds and displays a File.
     *
     * @Route("/{id}/get/{filename}", name="file_get", defaults={"filename" = "name.ext"})
     *
     */
    public function getAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $file = $em->getRepository('AppBundle:File')->find($id);

        $name = $file->getName();

        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
        $path = $helper->asset($file, 'file');
        $ext = strtolower($file->getExt());
        $filename = $name . '.' . $ext;


        $response = new Response();

        $response->setStatusCode(200);
        switch ($ext) {
            case "png":
                $response->headers->set('Content-Type', 'image/png');
                $response->headers->set('Content-Disposition', 'filename="' . $filename . '"');
                break;
            case "gif":
                $response->headers->set('Content-Type', 'image/gif');
                $response->headers->set('Content-Disposition', 'filename="' . $filename . '"');
                break;
            case "jpeg":
                $response->headers->set('Content-Type', 'image/jpeg');
                $response->headers->set('Content-Disposition', 'filename="' . $filename . '"');
                break;
            case "jpg":
                $response->headers->set('Content-Type', 'image/jpeg');
                $response->headers->set('Content-Disposition', 'filename="' . $filename . '"');
                break;
            case "mpeg":
                $response->headers->set('Content-Type', 'audio/mpeg');
                $response->headers->set('Content-Disposition', 'filename="' . $filename . '"');
                break;
            case "mp3":
                $response->headers->set('Content-Type', 'audio/mp3');
                $response->headers->set('Content-Disposition', 'filename="' . $filename . '"');
                break;
            case "odt":
                $response->headers->set('Content-Type', 'application/vnd.oasis.opendocument.text');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "ods":
                $response->headers->set('Content-Type', 'application/vnd.oasis.opendocument.spreadsheet');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "odp":
                $response->headers->set('Content-Type', 'application/vnd.oasis.opendocument.presentation');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "doc":
                $response->headers->set('Content-Type', 'application/vnd.msword');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "docx":
                $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "ppt":
                $response->headers->set('Content-Type', 'application/vnd.mspowerpoint');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "pptx":
                $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.presentationml.presentation');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "xls":
                $response->headers->set('Content-Type', 'application/vnd.ms-excel');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "xlsx":
                $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            case "pdf":
                $response->headers->set('Content-Type', 'application/pdf');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
                break;
            default:
                $response->headers->set('Content-Type', 'application/octet-stream');
        }
        $response->setContent(file_get_contents($path));

        return $response;
    }

    /**
     * Displays a form to edit an existing File entity.
     *
     * @Route("/{id}/edit", name="file_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:File')->find($id);
        if (is_null($entity->getUrl()))
        {
            $type='upload';
        }
        else {
            $type='link';
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $editForm = $this->createEditForm($entity, $type);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a File entity.
    *
    * @param File $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(File $entity, $type)
    {
        if ($type=='upload') {
            $form = $this->createForm(new FileType(), $entity, array(
                'action' => $this->generateUrl('file_update', array('id' => $entity->getId(),'type'=>$type)),
                'method' => 'PUT',
            ));
        }
        else {
            $form = $this->createForm(new LinkType(), $entity, array(
                'action' => $this->generateUrl('file_update', array('id' => $entity->getId(),'type'=>$type)),
                'method' => 'PUT',
            ));
        }

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-default margin-top')));

        return $form;
    }
    /**
     * Edits an existing File entity.
     *
     * @Route("/{id}", name="file_update")
     * @Method("PUT")
     * @Template("AppBundle:File:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:File')->find($id);
        if (is_null($entity->getUrl()))
        {
            $type='upload';
        }
        else {
            $type='link';
        }


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $type);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('file'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a File entity.
     *
     * @Route("/{id}", name="file_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:File')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find File entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('file'));
    }

    /**
     * Creates a form to delete a File entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('file_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-danger'),))
            ->getForm()
        ;
    }
}
