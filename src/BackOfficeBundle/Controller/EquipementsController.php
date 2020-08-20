<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Equipements;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Equipement controller.
 *
 */
class EquipementsController extends Controller
{
    /**
     * Lists all equipement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findAll();

        return $this->render('@BackOffice/bloff/equipements/index1.html.twig', array(
            'equipements' => $equipements,
        ));
    }

    /**
     * Creates a new equipement entity.
     *
     */
    public function newAction(Request $request)
    {
        $equipement = new Equipements();
        $form = $this->createForm('BackOfficeBundle\Form\EquipementsType', $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($equipement);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Equipement ajouté avec succée !');

            return $this->redirectToRoute('equipements_show', array('id' => $equipement->getId()));
        }

        return $this->render('@BackOffice/bloff/equipements/new1.html.twig', array(
            'equipement' => $equipement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipement entity.
     *
     */
    public function showAction(Equipements $equipement)
    {
        $deleteForm = $this->createDeleteForm($equipement);

        return $this->render('@BackOffice/bloff/equipements/show1.html.twig', array(
            'equipement' => $equipement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipement entity.
     *
     */
    public function editAction(Request $request, Equipements $equipement)
    {
        $deleteForm = $this->createDeleteForm($equipement);
        $editForm = $this->createForm('BackOfficeBundle\Form\EquipementsType', $equipement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Equipement modifié avec succée !');
            return $this->redirectToRoute('equipements_show', array('id' => $equipement->getId()));


        }
        return $this->render('@BackOffice/bloff/equipements/edit1.html.twig', array(
            'equipement' => $equipement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equipement entity.
     *
     */
    public function deleteAction(Request $request, Equipements $equipement)
    {
        $form = $this->createDeleteForm($equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipement);
            $em->flush();

        }
        $this->get('session')->getFlashBag()->add('notice', 'Equipement supprimé avec succée !');
        return $this->redirectToRoute('equipements_index');
    }

    /**
     * Creates a form to delete a equipement entity.
     *
     * @param Equipements $equipement The equipement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipements $equipement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipements_delete', array('id' => $equipement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function findEquipementAction(Request $request){
        $nom= $_GET['nom'] ;
        $em = $this->getDoctrine()->getManager();
            $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findBy(array("fournisseur" => $nom));
        return $this->render('@BackOffice/bloff/equipements/filtre_equipement1.html.twig',array("equipements"=>$equipements)
        );


    }
    public function findSalleAction(Request $request){
        $nom= $_POST['salle'] ;
        $em = $this->getDoctrine()->getManager();
        $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findBy(array("salle" => $nom));
        return $this->render('@BackOffice/bloff/equipements/index1.html.twig',array("equipements"=>$equipements)
        );


    }
    public function findDomaineAction(Request $request){
        $nom= $_POST['domaine'] ;
        $em = $this->getDoctrine()->getManager();
        $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findBy(array("domaine" => $nom));
        return $this->render('@BackOffice/bloff/equipements/index1.html.twig',array("equipements"=>$equipements)
        );


    }
    public function findEquipementFAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findBy(array("etat" => "Fonctionnel"));
        return $this->render('@BackOffice/bloff/equipements/filtre_equipement1.html.twig',array("equipements"=>$equipements)
        );


    }
    public function findEquipementNfAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findBy(array("etat" => "Non Fonctionnel"));
        return $this->render('@BackOffice/bloff/equipements/filtre_equipement1.html.twig',array("equipements"=>$equipements)
        );


    }
    public function findEquipementMAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findBy(array("etat" => "En maintenance"
));
        return $this->render('@BackOffice/bloff/equipements/filtre_equipement1.html.twig',array("equipements"=>$equipements)
        );


    }

}
