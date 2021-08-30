<?php

namespace PI\MaterielBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIMaterielBundle:Default:index.html.twig');
    }
}
