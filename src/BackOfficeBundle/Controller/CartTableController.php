<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\CartTable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Carttable controller.
 *
 */
class CartTableController extends Controller
{
    /**
     * Lists all cartTable entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cartTables = $em->getRepository('BackOfficeBundle:CartTable')->findAll();

        return $this->render('@BackOffice/bloff/carttable/index.html.twig', array(
            'cartTables' => $cartTables,
        ));
    }

    /**
     * Creates a new cartTable entity.
     *
     */
    public function newAction(Request $request)
    {
        $cartTable = new Carttable();
        $form = $this->createForm('BackOfficeBundle\Form\CartTableType', $cartTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cartTable);
            $em->flush();

            return $this->redirectToRoute('carttable_show', array('id' => $cartTable->getId()));
        }

        return $this->render('@BackOffice/bloff/carttable/new.html.twig', array(
            'cartTable' => $cartTable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cartTable entity.
     *
     */
    public function showAction(CartTable $cartTable)
    {
        $deleteForm = $this->createDeleteForm($cartTable);

        return $this->render('@BackOffice/bloff/carttable/show.html.twig', array(
            'cartTable' => $cartTable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cartTable entity.
     *
     */
    public function editAction(Request $request, CartTable $cartTable)
    {
        $deleteForm = $this->createDeleteForm($cartTable);
        $editForm = $this->createForm('BackOfficeBundle\Form\CartTableType', $cartTable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carttable_edit', array('id' => $cartTable->getId()));
        }

        return $this->render('@BackOffice/bloff/carttable/edit.html.twig', array(
            'cartTable' => $cartTable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cartTable entity.
     *
     */
    public function deleteAction(Request $request, CartTable $cartTable)
    {
        $form = $this->createDeleteForm($cartTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cartTable);
            $em->flush();
        }

        return $this->redirectToRoute('carttable_index');
    }

    /**
     * Creates a form to delete a cartTable entity.
     *
     * @param CartTable $cartTable The cartTable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CartTable $cartTable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carttable_delete', array('id' => $cartTable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
