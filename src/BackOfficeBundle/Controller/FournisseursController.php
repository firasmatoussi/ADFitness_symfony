<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Fournisseurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fournisseur controller.
 *
 */
class FournisseursController extends Controller
{
    /**
     * Lists all fournisseur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseurs = $em->getRepository('BackOfficeBundle:Fournisseurs')->findAll();

        return $this->render('@BackOffice/bloff/fournisseurs/index1.html.twig', array(
            'fournisseurs' => $fournisseurs,
        ));
    }

    /**
     * Creates a new fournisseur entity.
     *
     */
    public function newAction(Request $request)
    {
        $fournisseur = new Fournisseurs();
        $form = $this->createForm('BackOfficeBundle\Form\FournisseursType', $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try{
            $em->persist($fournisseur);
            $em->flush();
            }catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
                //throw new \Symfony\Component\HttpKernel\Exception\HttpException(409, "Transaction already exist" );
                $this->get('session')->getFlashBag()->add('notice','Fournisseur existe deja !');
                return $this->render('@BackOffice/bloff/fournisseurs/new1.html.twig', array(
                    'fournisseur' => $fournisseur,
                    'form' => $form->createView(),
                ));
                // return $this->redirectToRoute('fournisseurs_index');
            }
            $this->get('session')->getFlashBag()->add('notice','Fournisseur ajouté avec succée!');
            return $this->redirectToRoute('fournisseurs_show', array('id' => $fournisseur->getId()));
        }

        return $this->render('@BackOffice/bloff/fournisseurs/new1.html.twig', array(
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ));
    }

    public function findFournisseurAction(){


        $nom= $_GET['nom'] ;
        $em = $this->getDoctrine()->getManager();
        $fournisseur = $em->getRepository('BackOfficeBundle:Fournisseurs')->findBy(array('nom' => $nom));

            if(isset($fournisseur[0])) {
                return $this->redirectToRoute('fournisseurs_show', array('id' => $fournisseur[0]->getId()));
                //$this->get('session')->getFlashBag()->add('danger','Fournisseur n"existe plus dans la base de données !');
                //return $this->redirectToRoute('equipements_index');

            }
        $this->get('session')->getFlashBag()->add('danger','Fournisseur n"existe plus dans la base de données !');
        return $this->redirectToRoute('equipements_index');
        //return $this->redirectToRoute('fournisseurs_show', array('id' => $fournisseur[0]->getId()));

           // return $this->redirectToRoute('fournisseurs_index');        }
    }

    /**
     * Finds and displays a fournisseur entity.
     *
     */
    public function showAction(Fournisseurs $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);

        return $this->render('@BackOffice/bloff/fournisseurs/show1.html.twig', array(
            'fournisseur' => $fournisseur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fournisseur entity.
     *
     */
    public function editAction(Request $request, Fournisseurs $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);
        $editForm = $this->createForm('BackOfficeBundle\Form\FournisseursType', $fournisseur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {
                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Fournisseur modifié avec succée!');
                return $this->redirectToRoute('fournisseurs_show', array('id' => $fournisseur->getId()));
            }catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
                //throw new \Symfony\Component\HttpKernel\Exception\HttpException(409, "Transaction already exist" );
                $this->get('session')->getFlashBag()->add('notice','Fournisseur existe deja !');
                return $this->render('@BackOffice/bloff/fournisseurs/edit1.html.twig', array(
                    'fournisseur' => $fournisseur,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));}
        }

        return $this->render('@BackOffice/bloff/fournisseurs/edit1.html.twig', array(
            'fournisseur' => $fournisseur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fournisseur entity.
     *
     */
    public function deleteAction(Request $request, Fournisseurs $fournisseur)
    {
        $form = $this->createDeleteForm($fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fournisseur);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add('notice', 'Fournisseur supprimé avec succée !');

        return $this->redirectToRoute('fournisseurs_index');
    }

    /**
     * Creates a form to delete a fournisseur entity.
     *
     * @param Fournisseurs $fournisseur The fournisseur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fournisseurs $fournisseur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fournisseurs_delete', array('id' => $fournisseur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
