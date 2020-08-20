<?php

namespace CoursApiBundle\Controller;

use BackOfficeBundle\Entity\Cours;
use BackOfficeBundle\Entity\Reservation;
use BackOfficeBundle\Entity\Users;
use BackOfficeBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoursApiBundle:Default:index.html.twig');
    }

    public function showAction()
    {
        $cours=$this->getDoctrine()->getManager()
        ->getRepository('BackOfficeBundle:Cours')->findAll();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($cours);
        //dump($formatted);
        return new JsonResponse($formatted);
    }

    public function newCoursAction($lib,$type,$salle,$coach,$date,$place){

        $em=$this->getDoctrine()->getManager();
        $cours=new Cours();

        $cours->setLib($lib);
        $cours->setType($type);
        $cours->setSalle($salle);
        $cours->setCoachName($coach);
        $cours->setDate($date);
        $cours->setNbPlace($place);

        $em->persist($cours);
        $em->flush();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($cours);
        return new JsonResponse($formatted);

    }

    public function supprimerCoursAction($id){
        $em = $this->getDoctrine()->getManager();
        $cours=$em->getRepository("BackOfficeBundle:Cours")->find($id);

        $em->remove($cours);
        $em->flush();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($cours);
        return new JsonResponse($formatted);
    }


    public function modifierCoursAction(Request $request)
    {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();


        $cours = $em->getRepository("BackOfficeBundle:Cours")->find($id);

        //  $club->setLogo($fileName);
        $cours->setLib($request->get('lib'));
        $cours->setType($request->get('type'));
        $cours->setSalle($request->get('salle'));
        $cours->setCoachName($request->get('coach'));
        $cours->setDate($request->get('date'));
        $cours->setNbPlace($request->get('place'));

        $em->flush();

        //   }


        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($cours);
        return new JsonResponse($formatted);
    }

    public function newReservationAction($id,$lib,$username,$email){
        $reservation = new Reservation();
        $em = $this->getDoctrine()->getManager();

        $reservation = new Reservation();

        $cours=new Cours();

        $cours=$em->getRepository(Cours::class)->findById($id);


        foreach ($cours as $e)
        {
            $t=$e->getLib();
            $e->setNbPlace($e->getNbPlace()-1);
        }

        $reservation->setLib($lib);
        $reservation->setUsername($username);
        $reservation->setEmail($email);




        $em->persist($reservation);
        $em->flush();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($reservation);
        return new JsonResponse($formatted);
    }


    public function showReservAction()
    {
        $cours=$this->getDoctrine()->getManager()
            ->getRepository('BackOfficeBundle:Reservation')->findAll();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($cours);
        //dump($formatted);
        return new JsonResponse($formatted);
    }

    public function JasonUserrAction()
    {
        $cours=$this->getDoctrine()->getManager()
            ->getRepository('BackOfficeBundle:Users')->findAll();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($cours);
        //dump($formatted);
        return new JsonResponse($formatted);

    }






}
