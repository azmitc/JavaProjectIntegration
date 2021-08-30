<?php
/**
 * Created by PhpStorm.
 * User: Othman Ben Jemaa
 * Date: 30/03/2017
 * Time: 17:24
 */

namespace PI\ReclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;


class GrapheController extends Controller
{

    public function chartPieAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentages des réclamations par types');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT E
                FROM MyAppUserBundle:Reclamationrandonnee E ");
        $results=$query->getResult();
        $total = count($results);
       // echo("total ".$total);
        //
        $query1=$em->createQuery("SELECT E
                FROM MyAppUserBundle:Reclamationrandonnee E WHERE E.type='Vol'");
        $results1=$query1->getResult();
        $nb1 = count($results1);
        //
        $query2=$em->createQuery("SELECT E
                FROM MyAppUserBundle:Reclamationrandonnee E WHERE E.type='Perte'");
        $results2=$query2->getResult();
        $nb2 = count($results2);
        //
        $query3=$em->createQuery("SELECT E
                FROM MyAppUserBundle:Reclamationrandonnee E WHERE E.type='logement'");
        $results3=$query3->getResult();
        $nb3 = count($results3);
        //
        $query4=$em->createQuery("SELECT E
                FROM MyAppUserBundle:Reclamationrandonnee E WHERE E.type='problème avec un guide'");
        $results4=$query4->getResult();
        $nb4 = count($results4);
        //
        $query5=$em->createQuery("SELECT E
                FROM MyAppUserBundle:Reclamationrandonnee E WHERE E.type='problème avec un randonneur'");
        $results5=$query5->getResult();
        $nb5 = count($results5);
        //
        $query6=$em->createQuery("SELECT E
                FROM MyAppUserBundle:Reclamationrandonnee E WHERE E.type='Autre'");
        $results6=$query6->getResult();
        $nb6 = count($results6);
        /*************************************************************/
        //$reclamations= $em->getRepository('MyAppUserBundle:Reclamationrandonnee') > findAll();

        $nbType=array("Vol"=>$nb1, "Perte"=>$nb2, "logement"=>$nb3,"problème avec un guide"=>$nb4,"problème avec un randonneur"=>$nb5,"Autre"=>$nb6);
        $data = array();
        foreach ($nbType as $rec_type => $rec_nb) {
            $stat = array();
            array_push($stat, $rec_type,
                ($rec_nb * 100) / $total);
            //var_dump($stat);
            array_push($data, $stat);
        }
         //var_dump($data);
        $ob->series(array(array(
            'type' => 'pie',
            'name' => 'Browser share',
            'data' => $data)));
        //var_dump($ob);
        return $this->render('PIReclamationBundle:Graphe:pie.html.twig', array('chart' => $ob,'total'=>$total));
    }





}
