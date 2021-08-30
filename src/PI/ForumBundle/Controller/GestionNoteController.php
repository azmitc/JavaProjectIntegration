<?php

namespace PI\ForumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use MyApp\UserBundle\Entity\Note;

use PI\ForumBundle\Form\NoteForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GestionNoteController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function NoterAction($id,Request $request)
    {
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $note = new Note();
        $form1 = $this->createForm(NoteForm::class, $note);
        $form1->handleRequest($request);
        if ($form1->isValid()) {
$note->setIdRando($id);
            $note->setIdUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

        }
        return $this->render("PIForumBundle:FrontSujet:AjouteNote.html.twig", array('form' => $form1->createView()));
    }


}
