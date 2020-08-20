<?php

namespace FrontOfficeBundle\Controller;

use FrontOfficeBundle\Entity\Events;
use FrontOfficeBundle\Entity\Reservations;
use http\Env\Response;
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

        $reservations = $em->getRepository('FrontOfficeBundle:Reservations')->findAll();

        return $this->render('reserve/indexres.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    /**
     * Creates a new reservation entity.
     *
     */
    public function newAction(Request $request,$id)
    {
        $reservation = new Reservations();
        $em = $this->getDoctrine()->getManager();
        $event=new Events();
        $event=$em->getRepository(Events::class)->findById($id);

        foreach ($event as $e)
        {
            $t=$e->getTitre();
            $e->setNbP($e->getNbP()-1);
        }

       // $em->flush();



        $form = $this->createForm('FrontOfficeBundle\Form\ReservationsType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setEve($t);
            if ($reservation->getEmail()!="[a-zA-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$") {
                echo "<script>alert(\"vérifier votre email \")
                </script>";
            }
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservat_show', array('idr' => $reservation->getIdr()));
        }

        return $this->render('reserve\newres.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView()
        ));
    }



    /**
     * Finds and displays a reservation entity.
     *
     */
    public function showAction(Reservations $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('reserve/showres.html.twig', array(
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
        $editForm = $this->createForm('FrontOfficeBundle\Form\ReservationsType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservat_edit', array('idr' => $reservation->getIdr()));
        }

        return $this->render('reserve/editres.html.twig', array(
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

        return $this->redirectToRoute('reservat_index');
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Reservations $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createDeleteForm(Reservations $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservat_delete', array('idr' => $reservation->getIdr())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function affichageAction (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository(Reservations::class)->findAll() ;
        //var_dump($reservation);
        //die();

        return $this->render('reserve/show.html.twig',array('reservations'=>$reservation));


    }

}
