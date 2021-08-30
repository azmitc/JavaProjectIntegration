<?php
/**
 * Created by PhpStorm.
 * User: azmi
 * Date: 26/03/2017
 * Time: 11:02
 */

namespace PI\guidesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\UserBundle\Entity\Randonnee;

class RandonniiController extends Controller
{
    function afficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MyAppUserBundle:Randonnee")->findAll();

        return $this->render("PIguidesBundle:offre:afficherRandonni.html.twig",array("offres"=>$offres));
    }
function  sum(){
    $em=$this->getDoctrine()->getManager();
$repository=$em->getRepository("MyAppUserBundle:Randonnee");
    $query = $repository->createQueryBuilder('r')
        ->select('count(r.id)')
        ->getQuery()
        ->getSingleScalarResult();
        $result=$query->getResult();
    return $this->render("PIguidesBundle:offre:afficherRandonni.html.twig",array("result"=>$result));



}




}