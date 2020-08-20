<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Cours;
use BackOfficeBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FrontOfficeBundle\Entity\Notification;

/**
 * Reservation controller.
 *
 */
class ReservationController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->isMethod("Post")) {
            $lib = $request->get('choicer');
            $reservations = $em->getRepository('BackOfficeBundle:Reservation')->findBy(array("lib" => $lib));
        }
        return $this->render('@BackOffice/bloff/reservation/index.html.twig', array(
            "reservations" => $reservations,
        ));
    }

    public function afficherAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cours = $em->getRepository('BackOfficeBundle:Cours')->findAll();
        //$notification=$this->getDoctrine()->getManager()->getRepository('FrontOfficeBundle:Notification')->findAll();

        return $this->render('@BackOffice/bloff/reservation/reserv_index.html.twig', array(
            'cours' => $cours,
            //'notification'=>$notification
        ));
    }

    public function afficheReservAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservation = $em->getRepository('BackOfficeBundle:Reservation')->findAll();


        return $this->render('@BackOffice/bloff/reservation/allReserv.html.twig', array(
            'reservations' => $reservation,
        ));
    }


    /**
     * Creates a new reservation entity.
     *
     */
    public function newAction(Request $request)
    {
        $reservation = new Reservation();

        $form = $this->createForm('BackOfficeBundle\Form\ReservationType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservation_show_admin', array('id' => $reservation->getId()));
        }

        return $this->render('@BackOffice/bloff/reservation/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     */
    public function showAction(Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('@BackOffice/bloff/reservation/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing reservation entity.
     *
     */
    public function editAction(Request $request, Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('BackOfficeBundle\Form\ReservationType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_edit_admin', array('id' => $reservation->getId()));
        }

        return $this->render('@BackOffice/bloff/reservation/edit.html.twig', array(
            'reservation' => $reservation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirectToRoute('all_reserv_index_admin');
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Reservation $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservation $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete_admin', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function reserverForAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $cours=new Cours();
        $lib=$request->get('librc');
        $cours = $em->getRepository('BackOfficeBundle:Cours')->find($lib);

        if($cours->getNbPlace()>0){
            $cours->setNbPlace($cours->getNbPlace() - 1);
            $em->persist($cours);
            $em->flush();
            return $this->redirectToRoute('reservation_index');
        }
        elseif(($cours->getNbPlace())==0){
            echo "<script>alert(\"nombre de place non disponible \")
                </script>";
            $em->persist($cours);
            $em->flush();
            return $this->redirectToRoute('pageformation');

        }
    }
}
