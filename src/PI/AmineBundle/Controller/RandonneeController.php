<?php

namespace PI\AmineBundle\Controller;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;
use PI\AmineBundle\Form\ModifForm;
use PI\AmineBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PI\AmineBundle\Form\AjoutRandonneeForm;
use MyApp\UserBundle\Entity\Randonnee;
use MyApp\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;




class RandonneeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function AllrandoAction()
    {

        $em=$this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->findBy(array("etat"=>1));
        return $this->render("PIAmineBundle:Randonnee:Allrando.html.twig",array("randonnee"=>$randonnee));
    }

    public function afficherrandonneeAction($id)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $username = $user->getUsername();
        }
        $em=$this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->findBy(array("orgid"=>$username,"categorie"=>$id));
        return $this->render("PIAmineBundle:Randonnee:afficherandonnee.html.twig",array("randonnee"=>$randonnee));
    }
    function AjoutRandonneeAction(Request $request)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $username = $user->getUsername();
        }
        $randonnee=new Randonnee();
        $randonnee->setOrgid($username);
        $Form=$this->createForm(AjoutRandonneeForm::class,$randonnee);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($randonnee);
            $em->flush();
            return $this->redirectToRoute("affichecr");

        }
        return $this->render("PIAmineBundle:Randonnee:ajout.html.twig",array('form'=>$Form->createView()));
    }


    function SupprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->find($id);
        $em->remove($randonnee);
        $em->flush();

        return $this->redirectToRoute("affichecr");

    }
    public function RafficherrandonneeAction($id)
{



    $em=$this->getDoctrine()->getManager();
    $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->findBy(array("categorie"=>$id,"etat"=>1));
    return $this->render("PIAmineBundle:Randonnee/Rondonneur:afficherandonnee.html.twig",array("randonnee"=>$randonnee));

}
/*
    public function AafficherrandonneeAction()
    {



        $em=$this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->findBy(array("etat"=>0));
        return $this->render("PIAmineBundle:Admin:afficherandonnee.html.twig",array("randonnee"=>$randonnee));

    }

*/
    public function validerAction($id,Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $randonnee = $em->getRepository("MyAppUserBundle:Randonnee")->find($id);


        $randonnee->setEtat(1);
        $em->persist($randonnee);
        $em->flush();
        return $this->redirectToRoute("Aaffichecr");

    }



    public function detailRandonneeAction($id)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $username = $user->getUsername();
        }
        $em=$this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->findBy(array("orgid"=>$username,"id"=>$id));


        return $this->render("PIAmineBundle:Randonnee:detailrandonnee.html.twig",array("randonnee"=>$randonnee));
    }



    public function RdetailRandonneeAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->findOneBy(array('id'=>$id));
        $lieu=$randonnee->getLieu();

        $ville=$em->getRepository("MyAppUserBundle:City")->findOneBy(array("nom"=>$lieu));
        if($ville!=null) {
            $lo = $ville->getLongitude();
            $la = $ville->getLatitude();

            $map = new Map();

            $map->setCenter(new Coordinate($lo, $la));
            $map->setMapOption('zoom', 10);
            $marker = new Marker(new Coordinate($lo, $la));

            $map->getOverlayManager()->addMarker($marker);

        }
        else {
            $map = new Map();

            $map->setCenter(new Coordinate("36.7948008", "10.0031931"));
            $map->setMapOption('zoom', 10);
        }
        $weatherService = $this->get('pianosolo.weather');
        $weathersArray = $weatherService->getWeatherObject($randonnee->getLieu());
        $weatherObject = $weathersArray[0];
        $temperature = $weatherObject->getTemperature();

        return $this->render("PIAmineBundle:Randonnee/Rondonneur:detailrandonnee.html.twig",array("temperature"=>$temperature,"map"=>$map,"randonnee"=>$randonnee));
    }

    function UpdateAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->find($id);
        $Form=$this->createForm(ModifForm::class,$randonnee);
        $Form->handleRequest($request);
        if($Form->isValid())
        {
            $em->persist($randonnee);
            $em->flush();
            return $this->redirectToRoute("affichecr");

        }
        return $this->render("PIAmineBundle:Randonnee:modif.html.twig",array('form'=>$Form->createView()));
    }


    public function listAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $randonnee=$em->getRepository("MyAppUserBundle:Randonnee")->findDQL();



        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $randonnee,
            $request->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );

// parameters to template
        return $this->render('PIAmineBundle:Admin:aff.html.twig', array('pagination' => $pagination));
    }

    function rechDQLAction(Request $request)
    {
        $randonnee=new Randonnee();

        $em=$this->getDoctrine()->getManager();
        $randonnees=$em->getRepository("MyAppUserBundle:Randonnee")->findAll();
        $Form=$this->createForm(RechercheForm::class,$randonnee);
        $Form->handleRequest($request);
        if($Form->isValid())
        {
            $niveau=$randonnee->getNiveau();
            $categorie=$randonnee->getCategorie();
            $lieu=$randonnee->getLieu();
            $prix=$randonnee->getPrix();
            $dateDebut=$randonnee->getDateDebut();
            $randonnees=$em->getRepository("MyAppUserBundle:Randonnee")->rechDQL($niveau,$categorie,$lieu,$prix,$dateDebut);

        }

        return $this->render("PIAmineBundle:Randonnee/Rondonneur:Recherche.html.twig",array("randonnees"=>$randonnees,"form"=>$Form->createView()));
    }




}
