<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\RecHistorique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rechistorique controller.
 *
 */
class RecHistoriqueController extends Controller
{
    /**
     * Lists all recHistorique entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recHistoriques = $em->getRepository('BackOfficeBundle:RecHistorique')->findAll();

        return $this->render('@BackOffice/bloff/rechistorique/index.html.twig', array(
            'recHistoriques' => $recHistoriques,
        ));
    }

    /**
     * Creates a new recHistorique entity.
     *
     */
    public function newAction(Request $request)
    {
        $recHistorique = new Rechistorique();
        $form = $this->createForm('BackOfficeBundle\Form\RecHistoriqueType', $recHistorique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recHistorique);
            $em->flush();

            return $this->redirectToRoute('rechistorique_show', array('id' => $recHistorique->getId()));
        }

        return $this->render('@BackOffice/bloff/rechistorique/new.html.twig', array(
            'recHistorique' => $recHistorique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recHistorique entity.
     *
     */
    public function showAction(RecHistorique $recHistorique)
    {
        $deleteForm = $this->createDeleteForm($recHistorique);

        return $this->render('@BackOffice/bloff/rechistorique/show.html.twig', array(
            'recHistorique' => $recHistorique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recHistorique entity.
     *
     */
    public function editAction(Request $request, RecHistorique $recHistorique)
    {
        $deleteForm = $this->createDeleteForm($recHistorique);
        $editForm = $this->createForm('BackOfficeBundle\Form\RecHistoriqueType', $recHistorique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rechistorique_edit', array('id' => $recHistorique->getId()));
        }

        return $this->render('@BackOffice/bloff/rechistorique/edit.html.twig', array(
            'recHistorique' => $recHistorique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recHistorique entity.
     *
     */
    public function deleteAction(Request $request, RecHistorique $recHistorique)
    {
        $form = $this->createDeleteForm($recHistorique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recHistorique);
            $em->flush();
        }

        return $this->redirectToRoute('rechistorique_index');
    }

    /**
     * Creates a form to delete a recHistorique entity.
     *
     * @param RecHistorique $recHistorique The recHistorique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RecHistorique $recHistorique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rechistorique_delete', array('id' => $recHistorique->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
