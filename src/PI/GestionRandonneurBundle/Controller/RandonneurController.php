<?php

namespace PI\GestionRandonneurBundle\Controller;

use MyApp\UserBundle\Entity\Amis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PI\GestionRandonneurBundle\Form\AdminMailType;


class RandonneurController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /*******************************************************************************/
    public function RechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recherche=$request->get('recherchealerte');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $randonneur= $em->getRepository("MyAppUserBundle:User")->Search($recherche);

        $pagination = $this->get('knp_paginator')->paginate(
            $randonneur,
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/);
        /**********************************************************************************************/
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(AdminMailType::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('Randonneurs_affiche'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :
                    $this->get('session')->getFlashBag()->add(
                        'notice',
                        'Votre mail a ete envoyé!'
                    );
                    return $this->redirectToRoute('Randonneurs_affiche');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor ");
                }
            }
        }

        return $this->render('PIGestionRandonneurBundle::afficherRandonneur.html.twig', array('pagination' => $pagination,
            'form' => $form->createView()
        ));

    }
    /*************************************************************************************/
    public function afficheListeAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $dql   = "SELECT a FROM MyAppUserBundle:User a where a.roles='a:1:{i:0;s:15:\"ROLE_RANDONNEUR\";}'";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );
        /**********************************************************************************************/
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(AdminMailType::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('Randonneurs_affiche'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :
                    $this->get('session')->getFlashBag()->add(
                        'notice',
                        'Votre mail a ete envoyé!'
                    );
                    return $this->redirectToRoute('Randonneurs_affiche');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor ");
                }
            }
        }

        return $this->render('PIGestionRandonneurBundle::afficherRandonneur.html.twig', array('pagination' => $pagination,
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $myappContactMail = 'randonnitunisie@gmail.com';
        $myappContactPassword = 'randonni123';


        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setSourceIp('0.0.0.0')

            ->setPassword($myappContactPassword);


        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Reclamation au sujet de : ". $data["subject"]);
        $message ->setFrom(array($myappContactMail => "Message par Randonni Tunisie"));
        $message->setTo($data["email"]);
        $message->setBody(
            '<html>' .
            ' <head></head>' .
            ' <body>' .
            '  ContactMail :'.$myappContactMail.'<br> <img src="' .
            $message->embed(\Swift_Image::fromPath('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTlUk3RWQFMB0Ohupxe7xsQfw4PEOuBx59SNEmXrBk72C6Co4iy')) .
            '" alt="Image" /><br>'
            .$data["message"] .
            ' </body>' .
            '</html>',
            'text/html'
        );

        return $mailer->send($message);
    }
    /*************************************************************************************/


    public function supprimerAction($id){

        $em = $this -> getDoctrine()-> getManager();
        $m=$em->getRepository('MyAppUserBundle:User')->find($id);
        $em->remove($m);
        $em->flush();
        return $this->redirectToRoute('Randonneurs_affiche');
    }
    function desactiverAction($id)
    {

        //$user = new User();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:User')->find($id);
        var_dump($user);

        $user->setEnabled(false);
        $em->persist($user);
        $em->flush();

      //  return $this->redirectToRoute('Randonneurs_affiche');
        return $this->render('@PIGestionRandonneur/afficherRandonneur.html.twig');
    }
    function promoteAction($id)
    {

        //$user = new User();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:User')->find($id);
        //var_dump($user);
        $admin=array('ROLE_ADMIN');
        $user->setRoles($admin);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('Randonneurs_affiche');
    }


    public function afficheListeTousAction($nom,Request $request)
    {
        $user=$this->get("security.token_storage")->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $ami = new Amis();
        $ami->setNomAmis($nom);
        $ami->setNom($user);
        $em->persist($ami);
        $em->flush();
        return  $this->redirectToRoute('Liste_tous1');
    }

    public function afficheListeTous1Action(Request $request)
    {
        $user=$this->get("security.token_storage")->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("MyAppUserBundle:User")->AfficheAmiUnik($user);
        $amis = $em->getRepository("MyAppUserBundle:Amis")->AfficheAmiDuConnecte($user);

        return $this->render("PIGestionRandonneurBundle::listeAmis2.html.twig", array("users" => $users,"amis" => $amis));

    }
    public function supprimerAmiAction($id){

        $em = $this -> getDoctrine()-> getManager();
        $m=$em->getRepository('MyAppUserBundle:Amis')->find($id);
        $em->remove($m);
        $em->flush();
        return $this->redirectToRoute('Liste_tous1');
    }


}
