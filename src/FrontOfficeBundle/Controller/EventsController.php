<?php

namespace FrontOfficeBundle\Controller;

use FrontOfficeBundle\Entity\Events;
use FrontOfficeBundle\Entity\Productmagasin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Event controller.
 *
 */
class EventsController extends Controller
{
    /**
     * Lists all event entities.
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

        $events = $em->getRepository('FrontOfficeBundle:Events')->findAll();


        return $this->render('even/inde.html.twig', array(
            'events' => $events,
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Creates a new event entity.
     *
     */


    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Events $event)
    {$session = new Session();
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
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('even/sho.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */


    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Events $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Events $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Events $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
