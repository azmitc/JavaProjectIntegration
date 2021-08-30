<?php
/**
 * Created by PhpStorm.
 * User: azmi
 * Date: 28/03/2017
 * Time: 16:08
 */

namespace PI\guidesBundle\Controller;


use PI\guidesBundle\Form\MailForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function contactAction(Requestt $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(MailForm::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('my_app_mail_homepage'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :

                    return $this->redirectToRoute('admin_reclamation');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor 😞");
                }
            }
        }

        return $this->render('PIguidesBundle:Affichage:Email.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $myappContactMail = 'hedi.bennaceur@esprit.tn';
        $myappContactPassword = '21989176';


        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setSourceIp('0.0.0.0')

            ->setPassword($myappContactPassword);


        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Reclamation au sujet de : ". $data["subject"])
            ->setFrom(array($myappContactMail => "Message by ".$data["name"]))
            ->setTo(array(
                $myappContactMail => $myappContactMail
            ))
            ->setBody("   Message: ".$data["message"]."   ContactMail :".$data["email"]);

        return $mailer->send($message);
    }
}