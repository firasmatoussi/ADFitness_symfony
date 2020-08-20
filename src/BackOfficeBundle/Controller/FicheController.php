<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Fiche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fiche controller.
 *
 */
class FicheController extends Controller
{
    /**
     * Lists all fiche entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fiches = $em->getRepository('BackOfficeBundle:Fiche')->findAll();

        return $this->render('@BackOffice/bloff/fiche/index.html.twig', array(
            'fiches' => $fiches,
        ));
    }

    /**
     * Creates a new fiche entity.
     *
     */
    public function newAction(Request $request)
    {
        $fiche = new Fiche();
        $form = $this->createForm('BackOfficeBundle\Form\FicheType', $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush();

            return $this->redirectToRoute('fiche_show', array('id' => $fiche->getId()));
        }

        return $this->render('@BackOffice/bloff/fiche/new.html.twig', array(
            'fiche' => $fiche,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fiche entity.
     *
     */
    public function showAction(Fiche $fiche)
    {
        $deleteForm = $this->createDeleteForm($fiche);

        return $this->render('@BackOffice/bloff/fiche/show.html.twig', array(
            'fiche' => $fiche,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fiche entity.
     *
     */
    public function editAction(Request $request, Fiche $fiche)
    {
        $deleteForm = $this->createDeleteForm($fiche);
        $editForm = $this->createForm('BackOfficeBundle\Form\FicheType', $fiche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_edit', array('id' => $fiche->getId()));
        }

        return $this->render('@BackOffice/bloff/fiche/edit.html.twig', array(
            'fiche' => $fiche,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fiche entity.
     *
     */
    public function deleteAction(Request $request, Fiche $fiche)
    {
        $form = $this->createDeleteForm($fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fiche);
            $em->flush();
        }

        return $this->redirectToRoute('fiche_index');
    }

    /**
     * Creates a form to delete a fiche entity.
     *
     * @param Fiche $fiche The fiche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fiche $fiche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fiche_delete', array('id' => $fiche->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
