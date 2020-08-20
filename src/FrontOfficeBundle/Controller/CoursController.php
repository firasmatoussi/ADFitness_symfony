<?php


namespace FrontOfficeBundle\Controller;

use BackOfficeBundle\Entity\ProductMagasin;
use FrontOfficeBundle\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Cour controller.
 *
 */
class CoursController extends Controller
{
    /**
     * Lists all cour entities.
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

        $cours = $em->getRepository('FrontOfficeBundle:Cours')->findAll();

        return $this->render('@FrontOffice/floff/cours/index.html.twig', array(
            'cours' => $cours,
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Creates a new cour entity.
     *
     */
    public function newAction(Request $request)
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


        $cour = new Cours();
        $form = $this->createForm('FrontOfficeBundle\Form\CoursType', $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cour);
            $em->flush();

            return $this->redirectToRoute('cours_show', array('id' => $cour->getId()));
        }

        return $this->render('@FrontOffice/floff/cours/new.html.twig', array(
            'cour' => $cour,
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Finds and displays a cour entity.
     *
     */
    public function showAction(Cours $cour)
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
        $deleteForm = $this->createDeleteForm($cour);

        return $this->render('@FrontOffice/floff/cours/show.html.twig', array(
            'cour' => $cour,
            'delete_form' => $deleteForm->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    /**
     * Displays a form to edit an existing cour entity.
     *
     */
    public function editAction(Request $request, Cours $cour)
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


        $deleteForm = $this->createDeleteForm($cour);
        $editForm = $this->createForm('FrontOfficeBundle\Form\CoursType', $cour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('@FrontOffice/floff/cours_edit', array('id' => $cour->getId()));
        }

        return $this->render('cours/edit1.html.twig', array(
            'cour' => $cour,
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
     * Deletes a cour entity.
     *
     */
    public function deleteAction(Request $request, Cours $cour)
    {
        $form = $this->createDeleteForm($cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cour);
            $em->flush();
        }

        return $this->redirectToRoute('@FrontOffice/floff/cours_index');
    }

    /**
     * Creates a form to delete a cour entity.
     *
     * @param Cours $cour The cour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cours $cour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cours_delete', array('id' => $cour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function findCoachAction(Request $request){
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
        if($request ->isMethod("POST")){
            $coach = $request->get('firas');
            $cours = $em->getRepository('FrontOfficeBundle:Cours')->findBy(array("coachName"=>$coach));
        }

        return $this->render('@FrontOffice/floff/cours/coach_filtre.html.twig',array(
            "cours"=>$cours,
                'last_username' => $lastUsername,
                'error' => $error,
                'produitPanier' => $produitsPanier,
                'produits' => $Produits,
                'qte' => $qte,
            )
        );
    }


    public function findTypeAction(Request $request){
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
        if($request ->isMethod("POST")){
            $type = $request->get('fu');
            $cours = $em->getRepository('FrontOfficeBundle:Cours')->findBy(array("type"=>$type));
        }

        return $this->render('@FrontOffice/floff/cours/type_filtre.html.twig',array(
            "cours"=>$cours,
                'last_username' => $lastUsername,
                'error' => $error,
                'produitPanier' => $produitsPanier,
                'produits' => $Produits,
                'qte' => $qte,)
        );
    }


}
