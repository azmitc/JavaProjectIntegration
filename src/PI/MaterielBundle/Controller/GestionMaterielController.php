<?php
/**
 * Created by PhpStorm.
 * User: balha
 * Date: 21/03/2017
 * Time: 11:03
 */

namespace PI\MaterielBundle\Controller;
use MyApp\UserBundle\Entity\Materiel;
use MyApp\UserBundle\Entity\Reservation;
use PI\MaterielBundle\Form\AjouterMaterielForm;
use PI\MaterielBundle\Form\ModifierMaterielForm;
use PI\MaterielBundle\Form\QuantiteType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @var UploadedFile file
 */

class GestionMaterielController extends Controller
{
    /*
    function afficherAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $materiel=$em->getRepository("MyAppUserBundle:Materiel")->findAll();
        return $this->render("PIMaterielBundle:Affichage:AfficherMateriel.html.twig",array("materiels"=>$materiel));
    }*/
    public function afficherAction(Request $request){
        $em=$this->getDoctrine()->getManager();

        $materiel=$em->getRepository("MyAppUserBundle:Materiel")->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $materiel, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render("PIMaterielBundle:Affichage:AfficherMateriel.html.twig",array("pagination"=> $pagination));
    }



    public function SupprimeAction($reference){

        $em = $this -> getDoctrine()-> getManager();
        $m=$em->getRepository('MyAppUserBundle:Materiel')->find($reference);
        $em->remove($m);
        $em->flush();
        return $this->redirectToRoute('admin_materiel');
    }




    function UpdateAction($reference,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $materiel=$em->getRepository("MyAppUserBundle:Materiel")->find($reference);
        $Form=$this->createForm(ModifierMaterielForm::class,$materiel);
        $Form->handleRequest($request);
        if($Form->isValid())
        {
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute("admin_materiel");

        }
        return $this->render("PIMaterielBundle:Affichage:ModifierMateriel.html.twig",array('form'=>$Form->createView()));
    }




    function AjoutAction(Request $request)
    {
        $materiel=new Materiel();
        $Form=$this->createForm(AjouterMaterielForm::class,$materiel);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute("admin_materiel");
        }
        return $this->render("PIMaterielBundle:Affichage:AjoutMateriel.html.twig",array('form'=>$Form->createView()));
    }

    function RechercherAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $materiel=$em->getRepository("MyAppUserBundle:Materiel")->findAll();


        if($request->isMethod('POST')){

            $materiel=$em->getRepository("MyAppUserBundle:Materiel")
                ->findBy(array('nom' => $_POST['nom']));}



        return $this->render("PIMaterielBundle:Affichage:RechercherMateril.html.twig",array("materiels"=>$materiel));
    }



    public function afficherUserAction(Request $request){
        $em=$this->getDoctrine()->getManager();

        $materiel=$em->getRepository("MyAppUserBundle:Materiel")->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $materiel, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );

        return $this->render("PIMaterielBundle:Affichage:AfficherMaterielUser.html.twig",array("pagination"=> $pagination));
    }




    public function afficherUserSingleAction($id){

        $em=$this->getDoctrine()->getManager();
        $mat=$em->getRepository("MyAppUserBundle:Materiel")->find($id);

        return $this->render("PIMaterielBundle:Affichage:AfficherMaterielUserSingle.html.twig",array("mat"=> $mat));
    }

    public function RechercheUserAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recherche=$request->get('recherchealerte');
        $materiel= $em->getRepository("MyAppUserBundle:Materiel")->SearchAlerte($recherche);

        $pagination = $this->get('knp_paginator')->paginate(
            $materiel,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);

        return $this->render('PIMaterielBundle:Affichage:AfficherMaterielUser.html.twig', array(
            "pagination" => $pagination

        ));

    }













}