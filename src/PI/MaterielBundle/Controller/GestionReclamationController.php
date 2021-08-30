<?php
/**
 * Created by PhpStorm.
 * User: balha
 * Date: 23/03/2017
 * Time: 10:12
 */

namespace PI\MaterielBundle\Controller;


use MyApp\UserBundle\Entity\Materiel;
use Ob\HighchartsBundle\Highcharts\Highchart;
use PI\MaterielBundle\Form\AfficherUserReclamtionForm;
use PI\MaterielBundle\Form\ModifierRecUserForm;
use PI\MaterielBundle\Form\TraiterReclamation;
use PI\MaterielBundle\Form\AjoutReclamationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\UserBundle\Entity\Reclamation;
use Symfony\Component\HttpFoundation\Response;


class GestionReclamationController extends Controller
{

    function afficherAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("MyAppUserBundle:Reclamation")->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $reclamations, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );


        return $this->render("PIMaterielBundle:Affichage:AfficherReclamation.html.twig",array("pagination"=>$pagination));
    }


    public function SupprimeAction($id){

        $em = $this -> getDoctrine()-> getManager();
        $m=$em->getRepository('MyAppUserBundle:Reclamation')->find($id);
        $em->remove($m);
        $em->flush();
        return $this->redirectToRoute('admin_reclamation');
    }


    public function traiterRecAction(Request $Request,$id){

        $em=$this->getDoctrine()->getManager();
        $Reclamation=$em->getRepository('MyAppUserBundle:Reclamation')->find($id);
        $form=$this->createForm(TraiterReclamation::class,$Reclamation);
        $form->handleRequest($Request);
        if ($form->isValid())
        {
            $admin=$this->get("security.token_storage")->getToken()->getUser();
            $Reclamation->setIdAdmin($admin);
            $Reclamation->setEtatReclamation('traité');
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reclamation);
            $em->flush();
            return $this->redirectToRoute('admin_reclamation');

        }

        return $this->render('PIMaterielBundle:Affichage:TraiterReclamation.html.twig',array('form'=>$form->createView()));
    }






    public function pdfAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $admin=$this->get("security.token_storage")->getToken()->getUser();

        $demande = $em->getRepository('MyAppUserBundle:Reclamation')
            ->find($id);
        $html = $this->renderView('PIMaterielBundle:Affichage:Pdf.html.twig',array(
            'users'=>$admin,
            'demandes'=>$demande
        ));

        $filename = sprintf('reclamation-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );


    }


    public function ajoutClienAction (Request $request)
{
    $reclamation=new Reclamation();
    $datenow= new \DateTime('now');
    $Form=$this->createForm(AjoutReclamationForm::class,$reclamation);
    $Form->handleRequest($request);
    if ($Form->isValid()){
        $client=$this->get("security.token_storage")->getToken()->getUser();
        $reclamation->setIdclient($client);
        $reclamation->setDateEnvoi($datenow);

        $em=$this->getDoctrine()->getManager();
        $em->persist($reclamation);
        $em->flush();
        return $this->redirectToRoute("user_reclamationAffiche");
    }
    return $this->render("PIMaterielBundle:Affichage:AjoutReclamationUser.html.twig",array('form'=>$Form->createView()));

}


    public function afficherUserAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository('MyAppUserBundle:Reclamation')->findBy(array("idclient"=>$id),
            array('dateEnvoi' => 'DESC'));
        $paginator  = $this->get('knp_paginator');
        $ReclamationsPag = $paginator->paginate(
            $Reclamation, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );



        return $this->render('PIMaterielBundle:Affichage:AfficherUserReclamtion.html.twig', array("Reclamation" => $ReclamationsPag));
    }

    public function ModifierUserAction(request $Request,$id){


        $em=$this->getDoctrine()->getManager();
        $Reclamation=$em->getRepository('MyAppUserBundle:Reclamation')->find($id);
        if($Reclamation->getEtatReclamation()=='en cours') {
            $form = $this->createForm(ModifierRecUserForm::class, $Reclamation);
            $form->handleRequest($Request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $user=$this->get("security.token_storage")->getToken()->getUser();
                $Reclamation->setIdclient($user);
                $em->persist($Reclamation);
                $em->flush();

                return $this->redirectToRoute('user_reclamationAffiche');

            }

            return $this->render('PIMaterielBundle:Affichage:ModifierReclamationUser.html.twig', array('form' => $form->createView()));
        }


    }


    public function afficherUserRestAction(Request $Request,$id){

        $em=$this->getDoctrine()->getManager();
        $Reclamation=$em->getRepository('MyAppUserBundle:Reclamation')->find($id);
        $form=$this->createForm(AfficherUserReclamtionForm::class,$Reclamation);
        $form->handleRequest($Request);

        return $this->render('PIMaterielBundle:Affichage:AfficherUserSingleReclmation.html.twig',array('form'=>$form->createView()));


    }


    public function chartPieAction(){
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Mes reclamations');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $em= $this->container->get('doctrine')->getEntityManager();
        $classes = $em->getRepository('MyAppUserBundle:Reclamation')->findAll();
        $totalRec=0;
        foreach($classes as $classe) {
            $totalRec=$totalRec+1;
        }
        $data= array();
        $statr=array();
        $stat=array();
        $b='en cours';
        $a='traité';


        $ref=$em->getRepository('MyAppUserBundle:Reclamation')->statRef($a);//traité
        $sauto=$em->getRepository('MyAppUserBundle:Reclamation')->stat($b);//en cours

        array_push($statr,'traité',(($ref) *100)/$totalRec);
        array_push($stat,'en cours',(($sauto) *100)/$totalRec);


        //var_dump($stat);}

        array_push($data,$stat,$statr);

        // var_dump($data);
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('PIMaterielBundle:Affichage:pie.html.twig',
            array(
                'chart' => $ob
            ));
    }











}