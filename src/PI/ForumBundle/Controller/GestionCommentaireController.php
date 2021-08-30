<?php

namespace PI\ForumBundle\Controller;

use MyApp\UserBundle\Entity\Commentaire;
use MyApp\UserBundle \Entity\User;
use PI\ForumBundle\Form\AjoutCommentaireForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GestionCommentaireController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function afficheDiscAction()
    {$s=new User();
    $s->getPhoto();
        $user=$this->get("security.token_storage")->getToken()->getUser();
        return $this->render("PIForumBundle:Chat:DiscInt.html.twig", array("user1"=>$user,"s"=>$s));
    }
    function afficheComAction()
    {
        $em = $this->getDoctrine()->getManager();
        $comm = $em->getRepository("MyAppUserBundle:Commentaire")->findAll();
        $user=$this->get("security.token_storage")->getToken()->getUser();
        return $this->render("PIForumBundle:CommentaireView:AfficheCommentaire.html.twig", array("commentaire" => $comm,"user"=>$user));
    }



    function afficheComSujAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comm = $em->getRepository("MyAppUserBundle:Commentaire")->findBy(array("id"=>$id));
        return $this->render("PIForumBundle:CommentaireView:AfficheCommentaireSuj.html.twig", array("commentaire" => $comm));
    }



    function afficheComSujFrontAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comm = $em->getRepository("MyAppUserBundle:Commentaire")->findBy(array("id"=>$id));
        return $this->render("PIForumBundle:FrontSujet:AfficheSujetComFront.html.twig", array("commentaire" => $comm));
    }



    public function supprimeComAction($id){

        $em=$this->getDoctrine()->getManager();
       // $this->NbPartMoins($id);
        $commentaire=$em->getRepository('MyAppUserBundle:Commentaire')->find($id);
        $em->remove($commentaire);
        $em->flush();

        return $this->redirectToRoute('pi_commentaire_afficher');
    }

    public function SignaleComAction($id){

        $em=$this->getDoctrine()->getManager();
        $commentaire=$em->getRepository('MyAppUserBundle:Commentaire')->find($id);
        $commentaire->setSignals(1);
        $sujet=$em->getRepository('MyAppUserBundle:Sujet')->findOneBy(array("id"=>$commentaire->getId()));
        $em->flush();
        return $this->redirectToRoute('pi_sujet1Com_affiche_front',array("id"=>$sujet->getId()));
    }





    public function SignaleComMailAction($id){

        $em=$this->getDoctrine()->getManager();
        $commentaire=$em->getRepository('MyAppUserBundle:Commentaire')->find($id);
        $commentaire->setSignals(1);
        $em->flush();

        return $this->redirectToRoute('signal_mail',array("id"=>$id));

    }


    public function supprimeFrontComAction($id){

        $em=$this->getDoctrine()->getManager();
        $commentaire=$em->getRepository('MyAppUserBundle:Commentaire')->find($id);
        $sujet=$em->getRepository('MyAppUserBundle:Sujet')->findOneBy(array("id"=>$commentaire->getId()));
       $this->NbPartMoins($sujet->getId());
        $em->remove($commentaire);
        $em->flush();

        return $this->redirectToRoute('pi_sujet1Com_affiche_front',array("id"=>$sujet->getId()));
    }



    private function NbPart($id)
{

    $em=$this->getDoctrine()->getManager();
    //$Sujet = $em->getRepository("MyAppUserBundle:Sujet")->findBy(array("id"=>$id));
    $Sujet= $em->getRepository('MyAppUserBundle:Sujet')->find($id);
    $nb=$Sujet->getNbParticipants();
    $newNb=$nb+1;
    $Sujet->setNbParticipants($newNb);
    $em->persist($Sujet);
    $em->flush();
}
    private function NbPartMoins($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Sujet1= $em->getRepository('MyAppUserBundle:Sujet')->find($id);
        $nb=$Sujet1->getNbParticipants();
        $newNb=$nb-1;
        $Sujet1->setNbParticipants($newNb);
        $em->persist($Sujet1);
        $em->flush();
    }



    public function ajoutComAction($id,Request $Request)
    {
//$this->zzz($id);
         $currentDate=new \DateTime("now");
        $user=$this->get("security.token_storage")->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $comm = $em->getRepository("MyAppUserBundle:Commentaire")->findBy(array("id"=>$id));
        $moynote=$em->getRepository('MyAppUserBundle:Note')->MoyNote($id);
        $sujet = $em->getRepository("MyAppUserBundle:Sujet")->findBy(array("id"=>$id));
        $commentaire = new Commentaire();
        $form = $this->createForm(AjoutCommentaireForm::class, $commentaire);
        $form->handleRequest($Request);
        if ($form->isValid()) {
            $this->NbPart($id);
            $commentaire->setUserId($user);

            $commentaire->setDateenv($currentDate);
            $commentaire->setId($id);
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('pi_sujet1Com_affiche_front',array("id"=>$id));
        }
        return $this->render("PIForumBundle:FrontSujet:AfficheSujetComFront.html.twig", array('form' => $form->createView(),"sujet" => $sujet,"commentaire"=>$comm,"us" => $user,"moy"=>$moynote));
    }



    public function RechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recherche=$request->get('recherchealerte');
        $alerte= $em->getRepository("MyAppUserBundle:Commentaire")->rech($recherche);


        return $this->render('PIForumBundle:CommentaireView:RechercheCom.html.twig', array(
            "alerte" => $alerte

        ));

    }

}
