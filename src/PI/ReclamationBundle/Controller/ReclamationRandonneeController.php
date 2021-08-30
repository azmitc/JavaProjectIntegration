<?php

namespace PI\ReclamationBundle\Controller;

use MyApp\UserBundle\Entity\Reclamationrandonnee;
use PI\ReclamationBundle\Form\ReclamationForm;
use PI\ReclamationBundle\Form\TraiterReclamationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReclamationRandonneeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficheListeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
       // $Reclamations = $em->getRepository('MyAppUserBundle:Reclamationrandonnee')->findAll();
        $dql   = "SELECT a FROM MyAppUserBundle:Reclamationrandonnee a where a.etat='en cours' ORDER BY a.dateEnvoi ASC ";
        $Reclamations = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $Reclamations, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('PIReclamationBundle::afficherReclamation.html.twig', array('pagination' => $pagination));
    }

    public function afficherRecUserAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository('MyAppUserBundle:Reclamationrandonnee')->findBy(array("Randonneur"=>$id),
            array('dateEnvoi' => 'DESC'));
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $Reclamation, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );



        return $this->render('PIReclamationBundle::AfficherUserReclamtion.html.twig', array("pagination" => $pagination));
    }
    public function detailRecAction($id){

        $em=$this->getDoctrine()->getManager();
        $Reclamation=$em->getRepository('MyAppUserBundle:Reclamationrandonnee')->find($id);


        return $this->render('PIReclamationBundle::detailsRec.html.twig',array("Reclamation"=>$Reclamation));


    }
    public function traiterRecAction(Request $Request,$id){

        $em=$this->getDoctrine()->getManager();
        $Reclamation=$em->getRepository('MyAppUserBundle:Reclamationrandonnee')->find($id);
        $form=$this->createForm(TraiterReclamationForm::class,$Reclamation);
        $form->handleRequest($Request);
        if ($form->isValid())
        {

            $admin=$this->get("security.token_storage")->getToken()->getUser();
            //var_dump($admin);
            $Reclamation->setAdminTraiteur($admin);
            $Reclamation->setEtat('traité');
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reclamation);
            $em->flush();
            return $this->redirectToRoute('reclamationRand_affiche');

        }

        return $this->render('PIReclamationBundle::TraiterReclamation.html.twig',array('form'=>$form->createView()));
    }
    public function ajouterAction(Request $Request)
    {
        $Reclamation = new Reclamationrandonnee();
        $form = $this->createForm(ReclamationForm::class, $Reclamation);
        $form->handleRequest($Request);
        $f=(string)$form->getErrors(true);
        //var_dump($f);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $user=$this->get("security.token_storage")->getToken()->getUser();
            $Reclamation->setRandonneur($user);
           // var_dump($Reclamation);
            $em->persist($Reclamation);
            $em->flush();
            return $this->redirectToRoute('reclamationRand_afficheUser');

        }
        return $this->render('PIReclamationBundle::AjouterUserReclamation.html.twig', array('form' => $form->createView()));
    }
    public function SupprimerRecAction($id){


        $em=$this->getDoctrine()->getManager();
        $Reclamation=$em->getRepository('MyAppUserBundle:Reclamationrandonnee')->find($id);
            $em->remove($Reclamation);
            $em->flush();
        return $this->redirectToRoute('reclamationRand_afficheUser');

    }
    public function ModifierRecAction(request $Request,$id){


        $em=$this->getDoctrine()->getManager();
        $Reclamation=$em->getRepository('MyAppUserBundle:Reclamationrandonnee')->find($id);
        if($Reclamation->getEtat()=='en cours') {
            $form = $this->createForm(ReclamationForm::class, $Reclamation);
            $form->handleRequest($Request);

            if ($form->isSubmitted()) {
                $em = $this->getDoctrine()->getManager();
                $user=$this->get("security.token_storage")->getToken()->getUser();
                $Reclamation->setRandonneur($user);
                $em->persist($Reclamation);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Votre réclamation a eté rectifiée avec succès '
                );
                return $this->redirectToRoute('reclamationRand_afficheUser');

            }

            return $this->render('PIReclamationBundle::ModifierUserReclamation.html.twig', array('form' => $form->createView()));
        }
        return $this->render('HostGuestBundle:Reclamation:ImpossiblieUserModificationRec.html.twig');

    }
    public function pdfAction($idDemande)
    {
        $em= $this->getDoctrine()->getManager();
        $user=$this->get("security.token_storage")->getToken()->getUser();

        $demande = $em->getRepository('MyAppUserBundle:Reclamationrandonnee')
            ->find($idDemande);
        $html = $this->renderView('PIReclamationBundle::Pdf.html.twig',array(
            'users'=>$user,
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


}

