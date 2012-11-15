<?php

namespace DW\SlideShowBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DW\SlideShowBundle\Entity\Image;
use DW\SlideShowBundle\Form\ImageType;

/**
 * Image controller.
 *
 */
class ImageController extends Controller {

    /**
     * Lists all Image entities.
     *
     */
    public function indexAction() {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DWSlideShowBundle:Image')->findAll();

        return $this->render('DWSlideShowBundle:Image:index.html.twig', array(
                    'entities' => $entities,
                ));
    }

    /**
     * Finds and displays a Image entity.
     *
     */
    public function showAction($id) {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWSlideShowBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DWSlideShowBundle:Image:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Image entity.
     *
     */
    public function newAction() {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        $entity = new Image();
        $form = $this->createForm(new ImageType(), $entity);

        return $this->render('DWSlideShowBundle:Image:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Creates a new Image entity.
     *
     */
    public function createAction(Request $request) {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        $entity = new Image();
        $form = $this->createForm(new ImageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $dir = 'shop_imgs/';


            $entity->setLink($form['link']->getData()->getClientOriginalName());
            $form['link']->getData()->move($dir, $form['link']->getData()->getClientOriginalName());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('image_show', array('id' => $entity->getId())));
        }

        return $this->render('DWSlideShowBundle:Image:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Displays a form to edit an existing Image entity.
     *
     */
    public function editAction($id) {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWSlideShowBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $editForm = $this->createForm(new ImageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DWSlideShowBundle:Image:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Edits an existing Image entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWSlideShowBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ImageType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('image_edit', array('id' => $id)));
        }

        return $this->render('DWSlideShowBundle:Image:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a Image entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DWSlideShowBundle:Image')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Image entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('image'));
    }

    private function createDeleteForm($id) {
        $userService = $this->get("userService");
        $userService->verify($this->getRequest()->getSession()->get('userAutentif'), array('ADMIN'));


        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
