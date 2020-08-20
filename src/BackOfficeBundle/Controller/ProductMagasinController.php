<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\ProductMagasin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Productmagasin controller.
 *
 */
class ProductMagasinController extends Controller
{
    /**
     * Lists all productMagasin entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productMagasins = $em->getRepository('BackOfficeBundle:ProductMagasin')->findAll();

        return $this->render('@BackOffice/bloff/productmagasin/index.html.twig', array(
            'productMagasins' => $productMagasins,
        ));
    }

    /**
     * Creates a new productMagasin entity.
     *
     */
    public function newAction(Request $request)
    {
        $productMagasin = new Productmagasin();
        $form = $this->createForm('BackOfficeBundle\Form\ProductMagasinType', $productMagasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productMagasin);
            $em->flush();

            return $this->redirectToRoute('productmagasin_show', array('id' => $productMagasin->getId()));
        }

        return $this->render('@BackOffice/bloff/productmagasin/new.html.twig', array(
            'productMagasin' => $productMagasin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a productMagasin entity.
     *
     */
    public function showAction(ProductMagasin $productMagasin)
    {
        $deleteForm = $this->createDeleteForm($productMagasin);

        return $this->render('@BackOffice/bloff/productmagasin/show.html.twig', array(
            'productMagasin' => $productMagasin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing productMagasin entity.
     *
     */
    public function editAction(Request $request, ProductMagasin $productMagasin)
    {
        $deleteForm = $this->createDeleteForm($productMagasin);
        $editForm = $this->createForm('BackOfficeBundle\Form\ProductMagasinType', $productMagasin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productmagasin_edit', array('id' => $productMagasin->getId()));
        }

        return $this->render('@BackOffice/bloff/productmagasin/edit.html.twig', array(
            'productMagasin' => $productMagasin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productMagasin entity.
     *
     */
    public function deleteAction(Request $request, ProductMagasin $productMagasin)
    {
        $form = $this->createDeleteForm($productMagasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productMagasin);
            $em->flush();
        }

        return $this->redirectToRoute('productmagasin_index');
    }

    /**
     * Creates a form to delete a productMagasin entity.
     *
     * @param ProductMagasin $productMagasin The productMagasin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductMagasin $productMagasin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productmagasin_delete', array('id' => $productMagasin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
