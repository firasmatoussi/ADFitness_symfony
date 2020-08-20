<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Reservations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Reservation controller.
 *
 */
class ReservationsController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('BackOfficeBundle:Reservations')->findAll();

        return $this->render('@BackOffice/bloff/reservations/index.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    /**
     * Creates a new reservation entity.
     *
     */
    public function newAction(Request $request)
    {
        $reservation = new Reservation();
        $form = $this->createForm('BackOfficeBundle\Form\ReservationsType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservations_show', array('idr' => $reservation->getIdr()));
        }

        return $this->render('@BackOffice/bloff/reservations/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     */
    public function showAction(Reservations $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('@BackOffice/bloff/reservations/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservation entity.
     *
     */
    public function editAction(Request $request, Reservations $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('BackOfficeBundle\Form\ReservationsType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservations_edit', array('idr' => $reservation->getIdr()));
        }

        return $this->render('@BackOffice/bloff/reservations/edit.html.twig', array(
            'reservation' => $reservation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Reservations $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirectToRoute('reservations_index');
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Reservations $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservations $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservations_delete', array('idr' => $reservation->getIdr())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
