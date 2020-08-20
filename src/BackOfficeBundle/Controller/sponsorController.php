<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Sponsor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sponsor controller.
 *
 */
class sponsorController extends Controller
{
    /**
     * Lists all sponsor entities.
     *
     */






    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT COUNT(a.idsp) AS nb , a.nomsp AS nm
FROM BackOfficeBundle:Acte a GROUP BY nb ORDER BY nb DESC ' );

        $top = $query->getScalarResult();

        $query2 = $em->createQuery('SELECT SUM (a.montant) AS mnt , a.nomsp AS nm
FROM BackOfficeBundle:Acte a GROUP BY a.idsp ORDER BY mnt DESC ' );
        $top2= $query2->getScalarResult();



        $sponsors = $em->getRepository('BackOfficeBundle:Sponsor')->findAll();
        return $this->render('@BackOffice/bloff/sponsor/index.html.twig', array(
            'sponsors' => $sponsors,'top'=>$top,'top2'=>$top2,
        ));
    }

    /**
     * Creates a new sponsor entity.
     *
     */
    public function newAction(Request $request)
    {
        $sponsor = new Sponsor();
        $form = $this->createForm('BackOfficeBundle\Form\sponsorType', $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($sponsor->getDatePacte() < (new \DateTime("now"))) {
                echo "<script>alert(\"veuillez vérifier la date ! \")
                </script>";
            }
            elseif (strlen($sponsor->getNom())<3 ) {
                echo "<script>alert(\"nom trés court \")
                </script>";


            }

            elseif (strlen($sponsor->getDomaine())<3 ) {
                echo "<script>alert(\"Domaine trés court \")
                </script>";


            }

            elseif (strlen($sponsor->getDomaine())<7 ) {
                echo "<script>alert(\"contact trés court \")
                </script>";


            }

            else {
            $em->persist($sponsor);
            $em->flush();

            return $this->redirectToRoute('sponsor_show', array('id' => $sponsor->getId()));
        } }

        return $this->render('@BackOffice/bloff/sponsor/new.html.twig', array(
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sponsor entity.
     *
     */
    public function showAction(Sponsor $sponsor)
    {
        $deleteForm = $this->createDeleteForm($sponsor);

        return $this->render('@BackOffice/bloff/sponsor/show.html.twig', array(
            'sponsor' => $sponsor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sponsor entity.
     *
     */
    public function editAction(Request $request, Sponsor $sponsor)
    {
        $deleteForm = $this->createDeleteForm($sponsor);
        $editForm = $this->createForm('BackOfficeBundle\Form\sponsorType', $sponsor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if ($sponsor->getDatePacte() < (new \DateTime("now"))) {
                echo "<script>alert(\"veuillez vérifier la date ! \")
                </script>";
            }
            elseif (strlen($sponsor->getNom())<3 ) {
                echo "<script>alert(\"nom trés court \")
                </script>";


            }

            elseif (strlen($sponsor->getDomaine())<3 ) {
                echo "<script>alert(\"Domaine trés court \")
                </script>";


            }

            elseif (strlen($sponsor->getContact())<8 ) {
                echo "<script>alert(\"contact trés court \")
                </script>";


            }

else {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sponsor_edit', array('id' => $sponsor->getId()));
            }}

        return $this->render('@BackOffice/bloff/sponsor/edit.html.twig', array(
            'sponsor' => $sponsor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sponsor entity.
     *
     */
    public function deleteAction(Request $request, Sponsor $sponsor)
    {
        $form = $this->createDeleteForm($sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sponsor);
            $em->flush();
        }

        return $this->redirectToRoute('sponsor_index');
    }

    /**
     * Creates a form to delete a sponsor entity.
     *
     * @param sponsor $sponsor The sponsor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sponsor $sponsor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sponsor_delete', array('id' => $sponsor->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
