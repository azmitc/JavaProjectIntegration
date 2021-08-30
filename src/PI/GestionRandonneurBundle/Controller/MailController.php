<?php

namespace PI\GestionRandonneurBundle\Controller;

use PI\GestionRandonneurBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function contactAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(MailType::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('app_mail_homepage'),
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
                    return $this->redirectToRoute('fos_user_profile_show');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor ");
                }
            }
        }

        return $this->render('PIGestionRandonneurBundle::Email.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $myappContactMail = $data["email"];
        $myappContactPassword = $data["password"];


        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setSourceIp('0.0.0.0')

            ->setPassword($myappContactPassword);


        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Reclamation au sujet de : ". $data["subject"]);
        $message ->setFrom(array($myappContactMail => "Message by ".$data["name"]));
        $message->setTo('randonnitunisie@gmail.com'
            );
        //$message ->setBody("   Message: ".$data["message"]."   ContactMail :".$data["email"]);
$message->setBody(
            '<html>' .
            ' <head></head>' .
            ' <body>' .
            '  ContactMail :'.$data["email"].' <br><img src="' .
            $message->embed(\Swift_Image::fromPath('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVa35AOLws3KCJsx1OJ-3PZ4K0ftwCZrEG_d3Bt7FXOBlNfWHYLw')) .
            '" alt="Image" /><br>'
             .$data["message"] .
            ' </body>' .
            '</html>',
            'text/html'
        );
        return $mailer->send($message);
    }
}
