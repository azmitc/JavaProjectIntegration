<?php

namespace PI\BaseBundle\Controller;

use MyApp\UserBundle\Entity\Historiqueanniv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DoctrineExtensions\Query\Mysql\Year;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $id=$this->getUser()->getId();

        $query=$em
            ->createQuery("SELECT a FROM MyAppUserBundle:Historiqueanniv a WHERE a.id= :id and SUBSTRING(a.birthday, 1, 4) = SUBSTRING(CURRENT_DATE(), 1, 4) ")
            ->setParameter('id',$id);

        $results = $query->getResult();
        $nb = count($results);
       // var_dump($nb);

       /*************************************/
        //$user=$this->get("security.token_storage")->getToken()->getUser();


        $user=$this->getUser();
        //var_dump($user);


        $aujourdui=date('Y-m-d');

        $maintenant=date('m-d');
      //  var_dump($maintenant);
        $dateannivpts=$user->getBirthday()->format('m-d');
       // var_dump($dateannivpts);

        if ($maintenant ==$dateannivpts)
        {
            if ($nb==0) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Votre cadeau vous attend dans votre profil :) '
                );

                /*************************************/
                $em = $this->getDoctrine()->getManager();
                $user->setPtFidel($user->getPtFidel() + 20);
                $em->persist($user);
                $em->flush();
                /*************************************************************/

                 $this->ajoutHistorique($id);

                return $this->render('PIBaseBundle:Default:index.html.twig');
            }
        }

        return $this->render('PIBaseBundle:Default:index.html.twig');
    }
    function ajoutHistorique($id){

        $aujourdui=date('Y-m-d');
        $em2=$this->getDoctrine()->getManager();

        $user = $em2->getRepository('MyAppUserBundle:User')->find($id);
        $historiqanniv=new Historiqueanniv();
        $historiqanniv->setUserName($user->getUsername());
        $historiqanniv->setBirthday($aujourdui);
       // var_dump($historiqanniv);
        $em2->persist($historiqanniv);
        $em2->flush();
    }






}
