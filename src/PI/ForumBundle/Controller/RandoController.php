<?php

namespace PI\ForumBundle\Controller;

use MyApp\UserBundle\Entity\Randonne;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RandoController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }



    public function RdetailRandonneeAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $randonne=$em->getRepository("MyAppUserBundle:Randonne")->find($id);
        $randonnee=$em->getRepository("MyAppUserBundle:Randonne")->findBy(array("id"=>$id));
        $d=$randonne->getDateFin();

        return $this->render("PIForumBundle:rando:detailrandonnee.html.twig",array(/*"temperature"=>$temperature,*/"randonnee"=>$randonnee));
    }

    public function RafficherrandonneeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $randonnee=$em->getRepository("MyAppUserBundle:Randonne")->findBy(array("categorie"=>$id));
        return $this->render("PIForumBundle:rando:afficherandonnee.html.twig",array("randonnee"=>$randonnee));

    }

}
