<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Assurance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Swift_SmtpTransport,\Swift_Mailer,\Swift_Message;

/**
 * assurance controller.
 *
 */
class assuranceController extends Controller
{
    /**
     * Lists all assurance entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assurances = $em->getRepository('BackOfficeBundle:Assurance')->findAll();
        $colors=array();
        $i=-1;
        foreach($assurances as $a) {
            $i++;
            $date1=date_create();
            $diff=date_diff($date1,$a->getExpire());

            $d=intval($diff->format("%R%a"));
            if ($d>30) {
                $colors[]="green";
            }
            elseif ($d>0 and $d<=30){
                $colors[]="orange" ;
            }
            else{
                $colors[] ="red" ;
            }

        }



        return $this->render('assurance/index.html.twig', array(
            'assurances' => $assurances ,'colors'=>$colors,
        ));
    }

    /**
     * Creates a new assurance entity.
     *
     */
    public function newAction(Request $request)
    {


        $assurance = new assurance();

        $form = $this->createForm('BackOfficeBundle\Form\assuranceType', $assurance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $assurance->setFullname($_GET['fullnam']) ;
            $assurance->setIdu($_GET['idu']) ;
            if ($assurance->getExpire() < (new \DateTime("now"))) {
                echo "<script>alert(\"veuillez vérifier la date ! \")
                </script>";
            }
            else {
                $em->persist($assurance);
                $em->flush();


            return $this->redirectToRoute('assurance_show', array('id' => $assurance->getId()));
        } }

        return $this->render('assurance/new.html.twig', array(
            'assurance' => $assurance,'idu'=>$_GET['idu'] ,'fullnam'=>$_GET['fullnam'],
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a assurance entity.
     *
     */
    public function showAction(assurance $assurance)
    {
        $deleteForm = $this->createDeleteForm($assurance);

        return $this->render('assurance/show.html.twig', array(
            'assurance' => $assurance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing assurance entity.
     *
     */
    public function editAction(Request $request, assurance $assurance)
    {
        $deleteForm = $this->createDeleteForm($assurance);
        $editForm = $this->createForm('BackOfficeBundle\Form\assuranceType', $assurance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($assurance->getExpire() < (new \DateTime("now"))) {
                echo "<script>alert(\"veuillez vérifier la date ! \")
                </script>";
            }
            else {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('assurance_edit', array('id' => $assurance->getId()));}
        }

        return $this->render('assurance/edit.html.twig', array(
            'assurance' => $assurance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a assurance entity.
     *
     */
    public function deleteAction(Request $request, assurance $assurance)
    {
        $form = $this->createDeleteForm($assurance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($assurance);
            $em->flush();
        }

        return $this->redirectToRoute('assurance_index');
    }

    /**
     * Creates a form to delete a assurance entity.
     *
     * @param assurance $assurance The assurance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(assurance $assurance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('assurance_delete', array('id' => $assurance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function  notifierAction (){
        $id=$_GET['idu'] ;


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT u.email AS mail 
FROM UserBundle:User u WHERE u.id =:id')->setParameter('id',$id) ;

        $mail = $query->getSingleResult();
        $m=$mail["mail"];



        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('testswiftmailer2018@gmail.com')
            ->setTo($m)
            ->setBody(' désolé pour le dérengement , votre assurance risque de expiré , pensez a payer votre assurance ,bonne journée'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $this->get('mailer')->send($message);
        return $this->render('assurance/notif.html.twig', array(
            'mail' => $m ,
        ));

    }

}
