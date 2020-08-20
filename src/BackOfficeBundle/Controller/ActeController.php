<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Acte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Acte controller.
 *
 */
class ActeController extends Controller
{
    /**
     * Lists all acte entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actes = $em->getRepository('BackOfficeBundle:Acte')->findAll();

        return $this->render('@BackOffice/bloff/acte/index.html.twig', array(
            'actes' => $actes,
        ));
    }

      public function actespAction()
    { $id =  $_GET['id'];
        $em = $this->getDoctrine()->getManager();

        $actes = $em->getRepository('BackOfficeBundle:Acte')->findBy(array("idsp"=>$id));

        return $this->render('@BackOffice/bloff/acte/index.html.twig', array(
            'actes' => $actes,
        ));
    }


    public function ajoutactespAction()
    { $id =  $_GET['id'];


        $em = $this->getDoctrine()->getManager();

        $actes = $em->getRepository('BackOfficeBundle:Acte')->findBy(array("idsp"=>$id));

        return $this->render('@BackOffice/bloff/acte/index.html.twig', array(
            'actes' => $actes,
        ));
    }



    /**
     * Creates a new acte entity.
     *
     */
    public function newAction(Request $request)
    {   $idsp= $_GET['id'] ;
        $nomsp= $_GET['nom'] ;
        $acte = new Acte();
        $form = $this->createForm('BackOfficeBundle\Form\ActeType', $acte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $acte->setIdsp($idsp) ;
            $acte->setNomsp($nomsp) ;
            if ($acte->getMontant() < 0) {
                echo "<script>alert(\"vérifiez le montant \")
                </script>";
            }
        else {
            $em->persist($acte);
            $em->flush();

            return $this->redirectToRoute('acte_show', array('id' => $acte->getId()));
        }}

        return $this->render('@BackOffice/bloff/acte/new.html.twig', array(
            'acte' => $acte,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a acte entity.
     *
     */
    public function showAction(Acte $acte)
    {
        $deleteForm = $this->createDeleteForm($acte);

        return $this->render('@BackOffice/bloff/acte/show.html.twig', array(
            'acte' => $acte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing acte entity.
     *
     */
    public function editAction(Request $request, Acte $acte)
    {
        $deleteForm = $this->createDeleteForm($acte);
        $editForm = $this->createForm('BackOfficeBundle\Form\ActeType', $acte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($acte->getMontant() < 0) {
                echo "<script>alert(\"vérifiez le montant \")
                </script>";
            }
else {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acte_edit', array('id' => $acte->getId())); }
        }

        return $this->render('@BackOffice/bloff/acte/edit.html.twig', array(
            'acte' => $acte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a acte entity.
     *
     */
    public function deleteAction(Request $request, Acte $acte)
    {
        $form = $this->createDeleteForm($acte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acte);
            $em->flush();
        }

        return $this->redirectToRoute('acte_index');
    }

    /**
     * Creates a form to delete a acte entity.
     *
     * @param Acte $acte The acte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Acte $acte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('acte_delete', array('id' => $acte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
