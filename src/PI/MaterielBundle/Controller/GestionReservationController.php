<?php
/**
 * Created by PhpStorm.
 * User: balha
 * Date: 25/03/2017
 * Time: 12:08
 */

namespace PI\MaterielBundle\Controller;


use MyApp\UserBundle\Entity\Materiel;
use MyApp\UserBundle\Entity\Reservation;
use PI\MaterielBundle\Form\ReserverForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GestionReservationController extends Controller
{
    public function afficherAdminAction(Request $request){
        $em=$this->getDoctrine()->getManager();

        $materiel=$em->getRepository("MyAppUserBundle:Reservation")->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $materiel, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render("PIMaterielBundle:Affichage:AfficherReservation.html.twig",array("pagination"=> $pagination));
    }






    public function SupprimeUserAction($id){

        $em = $this -> getDoctrine()-> getManager();
        $m=$em->getRepository('MyAppUserBundle:Reservation')->find($id);
        $em->remove($m);
        $em->flush();
        return $this->redirectToRoute('user_reservationAffichage');
    }



   function acheteAction($id,Request $request){
       $reservation= new Reservation();
       $form=$this->createForm(ReserverForm::class,$reservation);
       $form->handleRequest($request);
       $em=$this->getDoctrine()->getManager();
       $mat = $em->getRepository('MyAppUserBundle:Materiel')->find($id);
       $dateres= new \DateTime('now');
       $user=$this->get("security.token_storage")->getToken()->getUser();
       $reservation->setIdclient($user);
       $reservation->setIdmateriel($mat);
       $reservation->setDateres($dateres);
       $quantite=$reservation->getQuantite();
       $prix=$mat->getPrix();
       $quanti=$mat->getQuantite();

 if
     ($quanti>=$quantite){
       if ($form->isValid()){
           $this->UpdateQuantite($id,$request);

           $reservation->setPrix($prix*$quantite);
            $em->persist($reservation);
            $em->flush();
           return $this->redirectToRoute("user_reservationAffichage");

       }}
       else echo"Impossible car notre stock est insufisant";
        return $this->render("PIMaterielBundle:Affichage:ReserverMateriel.html.twig",array('form'=>$form->createView()));
    }


   private function UpdateQuantite($id,Request $request)
    {
        $reservation=new Reservation();

        $em=$this->getDoctrine()->getManager();

        $materiel= $em->getRepository('MyAppUserBundle:Materiel')->find($id);
        $Form=$this->createForm(ReserverForm::class,$reservation);
        $Form->handleRequest($request);
        $i=$materiel->getQuantite();


        $quantite=$reservation->getQuantite();

        if ( $Form->isValid()){

            $materiel->setQuantite($i-$quantite);

            $em->persist($materiel);
            $em->flush();
        }


    }






    public function afficherUserResvAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository('MyAppUserBundle:Reservation')->findBy(array("idclient"=>$id));
        $paginator  = $this->get('knp_paginator');
        $ReclamationsPag = $paginator->paginate(
            $Reclamation, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );



        return $this->render('PIMaterielBundle:Affichage:AfficherUserReservation.html.twig', array("Reservation" => $ReclamationsPag));
    }





}