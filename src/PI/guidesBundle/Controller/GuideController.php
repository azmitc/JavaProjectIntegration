<?php
/**
 * Created by PhpStorm.
 * User: azmi
 * Date: 21/03/2017
 * Time: 11:08
 */

namespace PI\guidesBundle\Controller;




use MyApp\UserBundle \Entity\User;
use PI\guidesBundle\Form\AjoutForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Tests\UriSignerTest;

class GuideController extends Controller
{
    function Ajout2Action(Request $request)
    {
        $Offre=new User();
        $Form=$this->createForm(AjoutForm::class,$Offre);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Offre);
            $em->flush();
            return $this->redirectToRoute("esprit_parc_aff");
        }

        return $this->render("PIguidesBundle:offre:Ajoutguide.html.twig",array('form'=>$Form->createView()));
    }
    function afficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:User")->findAll();

        return $this->render("PIguidesBundle:offre:afficherguide.html.twig",array("offres"=>$offres));
    }
    function suppAction($id){
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:User")->find($id);
        $em->remove($offres);
        $em->flush();
        return$this->redirectToRoute("esprit_parc_aff");
    }
    public function updateAction ($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("MyAppUserBundle:User")->find($id);
        $form=$this->createForm(ajoutForm::class,$modele);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute("esprit_parc_aff");
        }
        return $this->render("PIguidesBundle:offre:Ajoutguide.html.twig",array('form'=>$form->createView()));

    }
    function disponibleAction($id){
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:User")->find($id);
        $offres->setDisponibilite(0);
        $em->flush();
        return$this->redirectToRoute("esprit_parc_aff");
    }
    function indisponibleAction($id){
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:User")->find($id);
        $offres->setDisponibilite(1);
        $em->flush();
        return$this->redirectToRoute("esprit_parc_aff");
    }

}