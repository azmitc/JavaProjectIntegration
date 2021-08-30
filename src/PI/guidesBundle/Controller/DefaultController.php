<?php

namespace PI\guidesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIguidesBundle:Default:index.html.twig');
    }
}
