<?php

namespace PI\ReclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIReclamationBundle:Default:index.html.twig');
    }
}
