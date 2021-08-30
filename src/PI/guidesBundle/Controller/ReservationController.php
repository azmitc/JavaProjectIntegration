<?php
/**
 * Created by PhpStorm.
 * User: azmi
 * Date: 24/03/2017
 * Time: 13:13
 */

namespace PI\guidesBundle\Controller;



use MyApp\UserBundle\Entity\Reservationr;
use PI\guidesBundle\Form\AjoutReser;
use PI\MaterielBundle\Form\AjouterMaterielForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Tests\UriSignerTest;

class ReservationController extends Controller
{


    function ResRandAction($id,Request $request){
        $reservationr= new Reservationr();
        $form=$this->createForm(AjoutReser::class,$reservationr);
        $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        $ran = $em->getRepository('MyAppUserBundle:Randonnee')->find($id);
        $dateres= new \DateTime('now');
        $user=$this->get("security.token_storage")->getToken()->getUser();
        $reservationr->setIdUser($user);
        $reservationr->setIdRondonne($ran);
        $reservationr->setDateres($dateres);
        $nbrplace=$reservationr->getNombreplace();
        $prix=$ran->getPrix();
        $nbrp=$ran->getNbrplace();
        $reservationr->setPrix($prix);

        if
        ($nbrp>=$nbrplace){
            if ($form->isValid()){
                $this->UpdateRand($id,$request);

                $reservationr->setTotal($prix*$nbrplace);
                $em->persist($reservationr);
                $em->flush();
                return $this->redirectToRoute("esprit_parc_aff1");

            }}
        else echo"Nombre de places restantes est insuffisant";
        return $this->render("PIguidesBundle:offre:AjoutReservation.html.twig",array('form'=>$form->createView()));
    }


    private function UpdateRand($id,Request $request)
    {
        $reservationr=new Reservationr();

        $em=$this->getDoctrine()->getManager();

        $materiel= $em->getRepository('MyAppUserBundle:Randonnee')->find($id);
        $Form=$this->createForm(AjoutReser::class,$reservationr);
        $Form->handleRequest($request);
        $i=$materiel->getNbrplace();


        $quantite=$reservationr->getNombreplace();

        if ( $Form->isValid()){

            $materiel->setNbrplace($i-$quantite);

            $em->persist($materiel);
            $em->flush();
        }


    }

    function Ajout2Action(Request $request)
    {
        $Offre=new Reservationr();
        $Form=$this->createForm(AjoutReser::class,$Offre);
        $Form->handleRequest($request);

        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("esprit_parc_aff1");
        }

        return $this->render("PIguidesBundle:offre:AjoutReservation.html.twig",array('form'=>$Form->createView()));
    }
    public function pdfAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $admin=$this->get("security.token_storage")->getToken()->getUser();

        $demande = $em->getRepository('MyAppUserBundle:Reservationr')
            ->find($id);
        $html = $this->renderView('PIguidesBundle:offre:Pdf.html.twig',array(
            'users'=>$admin,
            'demandes'=>$demande
        ));

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );


    }
    public function listAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $em = $this->get('doctrine.orm.entity_manager');
     
        $offre=$em->getRepository("MyAppUserBundle:Reservationr")->findBy(array("idUser"=>$id));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $offre,
            $request->query->get('page', 1)/*page number*/,
            8/*limit per page*/
        );

// parameters to template
        return $this->render('PIguidesBundle:offre:afficherReservation.html.twig', array('pagination' => $pagination,'offre'=>$offre));
    }
    public function list1Action(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM MyAppUserBundle:Reservationr a";
        $query = $em->createQuery($dql);
        $offre=$em->getRepository("MyAppUserBundle:Reservationr")->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page', 1)/*page number*/,
            3/*limit per page*/
        );

// parameters to template
        return $this->render('PIguidesBundle:offre:Reserver.html.twig', array('pagination' => $pagination,'offre'=>$offre));
    }/*

    /*

    function afficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:Reservationr")->findAll();

        return $this->render("PIguidesBundle:offre:afficherReservation.html.twig",array("offres"=>$offres));
    }*/
    function suppAction($id){
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:Reservationr")->find($id);
        $em->remove($offres);
        $em->flush();
        return$this->redirectToRoute("esprit_parc_aff1");
    }
    public function updateAction ($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("MyAppUserBundle:Reservationr")->find($id);
        $form=$this->createForm(AjoutReser::class,$modele);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute("esprit_parc_aff1");
        }
        return $this->render("PIguidesBundle:offre:AjoutReservation.html.twig",array('form'=>$form->createView()));

    }

}