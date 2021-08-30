<?php
/**
 * Created by PhpStorm.
 * User: azmi
 * Date: 24/03/2017
 * Time: 13:12
 */

namespace PI\guidesBundle\Controller;


use PI\guidesBundle\Form\AjoutorgForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Tests\UriSignerTest;

class OrganisateurController extends Controller
{
    function AjoutAction(Request $request)
    {
        $Offre=new User();
        $Form=$this->createForm(AjoutorgForm::class,$Offre);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Offre);
            $em->flush();
            return $this->redirectToRoute("esprit_parc_aff1");
        }

        return $this->render("PIguidesBundle:offre:Ajoutorg.html.twig",array('form'=>$Form->createView()));
    }
    function afficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:User")->findAll();

        return $this->render("PIguidesBundle:offre:afficherorg.html.twig",array("offres"=>$offres));
    }
    function suppAction($id){
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:User")->find($id);
        $em->remove($offres);
        $em->flush();
        return$this->redirectToRoute("esprit_parc_aff1");
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
            return $this->redirectToRoute("esprit_parc_aff1");
        }
        return $this->render("PIguidesBundle:offre:Ajoutorg.html.twig",array('form'=>$form->createView()));

    }

}