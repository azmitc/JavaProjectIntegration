<?php

namespace PI\GestionRandonneurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIGestionRandonneurBundle:Default:index.html.twig');
    }
}
