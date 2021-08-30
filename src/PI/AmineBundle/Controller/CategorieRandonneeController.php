<?php

namespace PI\AmineBundle\Controller;

use MyApp\UserBundle\Entity\Categorierandonnee;
use PI\AmineBundle\Form\ajoutcategorieform;
use PI\AmineBundle\Form\ModifcrForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieRandonneeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function AjoutcrAction(Request $request)
    {

        $crandonnee=new Categorierandonnee();
        $Form=$this->createForm(ajoutcategorieform::class,$crandonnee);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($crandonnee);
            $em->flush();
            return $this->redirectToRoute("Aaficheec");

        }

        return $this->render("PIAmineBundle:CategorieRandonnee:ajoutcr.html.twig",array('form'=>$Form->createView()));
    }
    public function affichercrandonneeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $crandonnee=$em->getRepository("MyAppUserBundle:Categorierandonnee")->findAll();

        return $this->render("PIAmineBundle:CategorieRandonnee:affichecatorg.html.twig",array("crandonnee"=>$crandonnee));
    }
    public function RaffichercrandonneeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $crandonnee=$em->getRepository("MyAppUserBundle:Categorierandonnee")->findAll();




            return $this->render("PIAmineBundle:CategorieRandonnee/Randonneur:Raffichecat.html.twig",array("crandonnee"=>$crandonnee));
    }
    public function AaffichercrandonneeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $crandonnee=$em->getRepository("MyAppUserBundle:Categorierandonnee")->findAll();
        return $this->render("PIAmineBundle:Admin:afficherandonnee.html.twig",array("crandonnee"=>$crandonnee));
    }



    function SuppAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cr = $em->getRepository("MyAppUserBundle:Categorierandonnee")->find($id);
        $em->remove($cr);
        $em->flush();

        return $this->redirectToRoute("Aaficheec");

    }
    function UpdateAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $cr=$em->getRepository("MyAppUserBundle:Categorierandonnee")->find($id);
        $Form=$this->createForm(ModifcrForm::class,$cr);
        $Form->handleRequest($request);
        if($Form->isValid())
        {
            $em->persist($cr);
            $em->flush();
            return $this->redirectToRoute("Aaficheec");

        }
        return $this->render("PIAmineBundle:Admin:modifcr.html.twig",array('form'=>$Form->createView()));
    }




}
