<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NotificationController extends Controller
{
    public function displayAction(){
        $notification=$this->getDoctrine()->getManager()->getRepository('FrontOfficeBundle:Notification')->findAll();
        return $this->render('@BackOffice/bloff/reservation/reserv_index.html.twig', array('notification'=>$notification));
    }
}
