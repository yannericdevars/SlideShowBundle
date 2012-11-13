<?php

namespace DW\SlideShowBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DW\SlideShowBundle\Entity\Item;
use DW\SlideShowBundle\Form\ItemType;
use \DW\UserBundle\Service\UserService;

/**
 * Item controller.
 *
 */
class ItemController extends Controller
{
    /**
     * Lists all Item entities.
     *
     */
    public function indexAction()
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DWSlideShowBundle:Item')->findAll();

        return $this->render('DWSlideShowBundle:Item:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Item entity.
     *
     */
    public function showAction($id)
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWSlideShowBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DWSlideShowBundle:Item:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Item entity.
     *
     */
    public function newAction()
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        $entity = new Item();
        $form   = $this->createForm(new ItemType(), $entity);

        return $this->render('DWSlideShowBundle:Item:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Item entity.
     *
     */
    public function createAction(Request $request)
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        $entity  = new Item();
        $form = $this->createForm(new ItemType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('item_show', array('id' => $entity->getId())));
        }

        return $this->render('DWSlideShowBundle:Item:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Item entity.
     *
     */
    public function editAction($id)
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWSlideShowBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $editForm = $this->createForm(new ItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DWSlideShowBundle:Item:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Item entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWSlideShowBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ItemType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('item_edit', array('id' => $id)));
        }

        return $this->render('DWSlideShowBundle:Item:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Item entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DWSlideShowBundle:Item')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Item entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('item'));
    }

    private function createDeleteForm($id)
    {
        UserService::verify($this->getRequest()->getSession()->get('userAutentif'));
        
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
