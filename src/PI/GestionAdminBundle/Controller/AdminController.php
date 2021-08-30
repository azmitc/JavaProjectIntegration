<?php

namespace PI\GestionAdminBundle\Controller;

use MyApp\UserBundle \Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficheListeAction(Request $request){
        $em=$this->getDoctrine()->getManager();

        $dql   = "SELECT a FROM MyAppUserBundle:User a where a.roles='a:1:{i:0;s:10:\"ROLE_ADMIN\";}'";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('PIGestionAdminBundle::afficherAdmin.html.twig', array('pagination' => $pagination));
    }
    public function supprimerAction($id){

        $em = $this -> getDoctrine()-> getManager();
        $m=$em->getRepository('MyAppUserBundle:User')->find($id);
        $em->remove($m);
        $em->flush();
        return $this->redirectToRoute('admin_affiche');
    }
    function desactiverAction($id)
    {



            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('MyAppUserBundle:User')->find($id);

            $user->setEnabled(false);

       //var_dump($user);

        $em->persist($user);
            $em->flush();

       return $this->redirectToRoute('admin_affiche');
       // return $this->render('@PIGestionAdmin/afficherAdmin.html.twig');
    }

    function activerAction($id)
    {



        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:User')->find($id);
        //var_dump($user);

        $user->setEnabled(true);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin_affiche');
        // return $this->render('@PIGestionAdmin/afficherAdmin.html.twig');
    }
    function promoteAction($id)
    {

        //$user = new User();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:User')->find($id);
        //var_dump($user);
        $admin=array('ROLE_RANDONNEUR');
        $user->setRoles($admin);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin_affiche');
    }

}
