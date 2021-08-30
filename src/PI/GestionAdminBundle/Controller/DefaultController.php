<?php

namespace PI\GestionAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIGestionAdminBundle:Default:index.html.twig');
    }
}
