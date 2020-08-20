<?php

namespace FrontOfficeBundle\Controller;

use BackOfficeBundle\Entity\ProductMagasin;
use FrontOfficeBundle\Entity\Notification;
use FrontOfficeBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FrontOfficeBundle\Entity\Cours;
use Symfony\Component\HttpFoundation\Session\Session;

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
    public function indexAction()
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }



        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('FrontOfficeBundle:Reservation')->findAll();

        return $this->render('@FrontOffice/floff/reservation/index.html.twig', array(
            'reservations' => $reservations,
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Creates a new reservation entity.
     *
     */
    public function newAction(Request $request,$id)
    {

        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }



        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $reservation = new Reservation();
        $em = $this->getDoctrine()->getManager();

        $cours=new Cours();
        $cours=$em->getRepository(Cours::class)->findById($id);

        foreach ($cours as $e)
        {
            $t=$e->getLib();
            $e->setNbPlace($e->getNbPlace()-1);
        }


        $form = $this->createForm('FrontOfficeBundle\Form\ReservationType', $reservation);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setLib($t);
            $em->persist($reservation);
            $em->flush();



            return $this->redirectToRoute('reservation_show_user', array('id' => $reservation->getId()));
        }
        $notification=$this->getDoctrine()->getManager()->getRepository('FrontOfficeBundle:Notification')->findAll();

        return $this->render('@FrontOffice/floff/reservation/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
            'notification' => $notification,
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     */
    public function showAction(Reservation $reservation)
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }



        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('@FrontOffice/floff/reservation/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Displays a form to edit an existing reservation entity.
     *
     */
    public function editAction(Request $request, Reservation $reservation)
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }



        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('FrontOfficeBundle\Form\ReservationType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_edit_user', array('id' => $reservation->getId()));
        }

        return $this->render('@FrontOffice/floff/reservation/edit.html.twig', array(
            'reservation' => $reservation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
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

        return $this->redirectToRoute('@FrontOffice/floff/reservation_index_user');
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
            ->setAction($this->generateUrl('reservation_delete_user', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
