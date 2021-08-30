<?php

namespace PI\ForumBundle\Controller;

use MyApp\UserBundle \Entity\User;
use PI\ForumBundle\Form\MailForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function contactAction($id,Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters



        $form = $this->createForm(MailForm::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('signal_mail',array("id"=>$id)),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);
            if($form->isValid()){
                // Send mail
                if($this->sendEmail($id,$form->getData())){
                    // Everything OK, redirect to wherever you want ! :
                    return $this->redirectToRoute('pi_commentaire_afficher');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor 😞");
                }
            }
        }
        return $this->render('PIForumBundle:FrontSujet:mail.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($id,$data){

        $myappContactMail = 'ahmed.mabrouk@esprit.tn';
        $myappContactPassword = 'Am270595';


        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setSourceIp('0.0.0.0')
            ->setPassword($myappContactPassword);
       /* $em = $this->getDoctrine()->getManager();
        $comm = $em->getRepository('MyAppUserBundle:Commentaire')->findBy(array("userId"=>$id));
        $auteur = $em->getRepository('MyAppUserBundle:User')->find($comm);
        $data["email"]=*/
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Commentaire Signalé : ". $data["subject"])
            ->setFrom(array($myappContactMail => "Message by ".$data["name"]))
            ->setTo($data["email"])
            ->setBody("   Message: ".$data["message"]."   ContactMail :".$data["email"]);

        return $mailer->send($message);
    }
}
