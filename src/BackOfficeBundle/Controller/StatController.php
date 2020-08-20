<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;


class StatController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function chartAction()
    {
        // Chart
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $equipements = $em->getRepository('BackOfficeBundle:Equipements')->findAll();
        $totalEquipement=0;
        $totalF=0;
        $totalNf=0;
        $totalM=0;

        foreach($equipements as $equipement) {
            $totalEquipement++;
            if($equipement->getEtat()=="Fonctionnel")
            {
                $totalF++;
            }
             if($equipement->getEtat()=="Non Fonctionnel")
            {
                $totalNf++;
            }
            if($equipement->getEtat()=="En maintenance")
            {
                $totalM++;
            }
        }
        $data= array();
        $stat=['etat', 'nbr'];
        $nb=0;
        array_push($data,$stat);
        //foreach($equipements as $equipement) {
        array_push($stat,"Fonctionnel",($totalF *100)/$totalEquipement);
        $nb=( $totalF*100)/$totalEquipement;
        $stat=["Fonctionnel",$nb];
        array_push($data,$stat);
        array_push($stat,"Non Fonctionnel",($totalNf *100)/$totalEquipement);
        $nb=( $totalNf*100)/$totalEquipement;
        $stat=["Non Fonctionnel",$nb];
        array_push($data,$stat);
        array_push($stat,"En maintenance",($totalM *100)/$totalEquipement);
        $nb=( $totalM*100)/$totalEquipement;
        $stat=["En maintenance",$nb];
        array_push($data,$stat);
        //}
        $pieChart->getData()->setArrayToDataTable( $data );
        $pieChart->getOptions()->setTitle('Pourcentages des equipements selon leur etat');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(1650);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $pieChart->getOptions()->setIs3D(true);



        return $this->render('@BackOffice/bloff/stat/showstat.html.twig', array('piechart' => $pieChart));
     }
        // Chart



}