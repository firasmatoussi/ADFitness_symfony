<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $em = $this->getDoctrine()->getManager();

        $cours = $em->getRepository('BackOfficeBundle:Cours')->findAll();

        return $this->render('@BackOffice/bloff/cours/index.html.twig', array(
            'cours' => $cours,
        ));
    }


    /**
     * Creates a new cour entity.
     *
     */
    public function newAction(Request $request)
    {
        $cour = new Cours();
        $form = $this->createForm('BackOfficeBundle\Form\CoursType', $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($cour->getDate() < (new \DateTime("now"))){
                echo "<script>alert(\"Veuillez vérifier la date ! \")
                </script>";
            }
            else if ($cour->getNbPlace() < 0) {
                echo "<script>alert(\"Veuillez vérifier le nombre des places \")
                </script>";
            }
            else {
                $em->persist($cour);
                $em->flush();

            return $this->redirectToRoute('cours_show_admin', array('id' => $cour->getId()));
        }}

        return $this->render('@BackOffice/bloff/cours/new.html.twig', array(
            'cour' => $cour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cour entity.
     *
     */
    public function showAction(Cours $cour)
    {
        $deleteForm = $this->createDeleteForm($cour);

        return $this->render('@BackOffice/bloff/cours/show.html.twig', array(
            'cour' => $cour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cour entity.
     *
     */
    public function editAction(Request $request, Cours $cour)
    {
        $deleteForm = $this->createDeleteForm($cour);
        $editForm = $this->createForm('BackOfficeBundle\Form\CoursType', $cour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_show_admin', array('id' => $cour->getId()));
        }

        return $this->render('@BackOffice/bloff/cours/edit.html.twig', array(
            'cour' => $cour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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

        return $this->redirectToRoute('cours_index_admin');
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
            ->setAction($this->generateUrl('cours_delete_admin', array('id' => $cour->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function findTypeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if($request ->isMethod("POST")){
            $type = $request->get('choice');
            $cours = $em->getRepository('BackOfficeBundle:Cours')->findBy(array("type"=>$type));
        }

        return $this->render('@BackOffice/bloff/cours/filtre.html.twig',array("cours"=>$cours)
        );
    }

    public function findCoachAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if($request ->isMethod("POST")){
            $coach = $request->get('firas');
            $cours = $em->getRepository('BackOfficeBundle:Cours')->findBy(array("coachName"=>$coach));
        }

        return $this->render('@BackOffice/bloff/cours/filtre_coach.html.twig',array("cours"=>$cours)
        );
    }


}
