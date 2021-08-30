<?php

namespace PI\ForumBundle\Controller;


use MyApp\UserBundle\Entity\Commentaire;
use MyApp\UserBundle\Entity\Sujet;
use PI\ForumBundle\Form\AjoutCommentaireForm;
use PI\ForumBundle\Form\AjoutSujetForm;
use PI\ForumBundle\Form\AjoutSujetFrontForm;
use PI\ForumBundle\Form\ModifSujetForm;
use PI\ForumBundle\Form\RechercheSujetForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;



class GestionSujetController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function ajouteeAction(Request $Request)
    {

        $sujet = new Sujet();
        $form = $this->createForm(AjoutSujetForm::class, $sujet);
        $form->handleRequest($Request);
        if ($form->isValid()) {
            $user = $this->get("security.token_storage")->getToken()->getUser();
            $sujet->setNameUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($sujet);
            $em->flush();
            return $this->redirectToRoute('pi_sujet_afficher');
        }
        return $this->render("PIForumBundle:SujetView:AjouteSujet.html.twig", array('form' => $form->createView()));
    }


    function afficheSujAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("MyAppUserBundle:Sujet")->findAll();

        $com = $em->getRepository("MyAppUserBundle:Commentaire")->findBy(array("signals"=>1));
        $nbCom=$em->getRepository('MyAppUserBundle:Commentaire')->CountCom();

        return $this->render("PIForumBundle:SujetView:AfficheSujet.html.twig", array("sujet" => $sujet,"com"=>$com,"nbcom"=>$nbCom));
    }

    function afficheSujNotifAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("MyAppUserBundle:Sujet")->findAll();

        return $this->render("PIBaseBundle::layout.html.twig", array("sujet" => $sujet));
    }


    public function supprimeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('MyAppUserBundle:Sujet')->find($id);
        $em->remove($sujet);
        $em->flush();
        return $this->redirectToRoute('pi_sujet_afficher');
    }


    public function rechercherAction(Request $request)
    {
        $sujet = new Sujet();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RechercheSujetForm::class, $sujet);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $sujet = $em->getRepository('MyAppUserBundle:Sujet')->findBy(array('titre' => $sujet->getTitre(), 'theme' => $sujet->getTheme()));
        }
        return $this->render("PIForumBundle:SujetView:test.html.twig", array('Form' => $form->createView(), 'sujet' => $sujet));
    }

    public function modifierSujAction(request $Request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $Sujet = $em->getRepository('MyAppUserBundle:Sujet')->find($id);

        $form = $this->createForm(ModifSujetForm::class, $Sujet);
        $form->handleRequest($Request);

        if ($form->isValid()) {

            $em->persist($Sujet);
            $em->flush();
            return $this->redirectToRoute('pi_sujet_afficher');
        }
        return $this->render('PIForumBundle:SujetView:ModifSujet.html.twig', array('form' => $form->createView()));
    }

    public function desactiverSujAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository('MyAppUserBundle:Sujet')->find($id);
        $Reclamation->setDisponibilite(0);
        $em->flush();
        return $this->redirectToRoute('pi_sujet_afficher');
    }

    public function activerSujAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository('MyAppUserBundle:Sujet')->find($id);
        $Reclamation->setDisponibilite(1);
        $em->flush();
        return $this->redirectToRoute('pi_sujet_afficher');
    }


    //////////////front
    function afficheSujFrontAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("MyAppUserBundle:Sujet")->findBy(array("disponibilite"=>1));
        //$moynote=$em->getRepository('MyAppUserBundle:Note')->MoyNote();


        $sujet2 = $em->getRepository("MyAppUserBundle:Sujet")->findAll();
        return $this->render("PIForumBundle:FrontSujet:AfficheSujetFront.html.twig", array("sujet" => $sujet,"suj" => $sujet2));
    }



    public function AjouteSujetFrontAction(Request $Request)
    {

        $sujet = new Sujet();
        $form = $this->createForm(AjoutSujetFrontForm::class, $sujet);
        $form->handleRequest($Request);
        if ($form->isValid()) {
            $user = $this->get("security.token_storage")->getToken()->getUser();
            $sujet->setNameUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($sujet);
            $em->flush();
            return $this->redirectToRoute('pi_sujet_affiche_front');
        }
        return $this->render("PIForumBundle:FrontSujet:AjouteSujetFront.html.twig", array('form' => $form->createView()));
    }


    public function RechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recherche=$request->get('recherchealerte');
        $alerte= $em->getRepository("MyAppUserBundle:Sujet")->reche($recherche);



        return $this->render('PIForumBundle:FrontSujet:RechercheSujet.html.twig', array(
            "alerte" => $alerte

        ));

    }


}
