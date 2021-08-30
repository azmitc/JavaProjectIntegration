<?php

namespace PI\AmineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIAmineBundle:Default:index.html.twig');
    }

    public function indexOrgAction()
    {
        return $this->render('PIAmineBundle::accueilorg.html.twig');
    }
    public function indexRandAction()
    {
        return $this->render('PIAmineBundle::accueilrand.html.twig');
    }
}
