<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function adminIndexAction()
    {
        return $this->render('UserBundle:Default:admin.html.twig');
    }
    
    public function fournisseurIndexAction()
    {
        return $this->render('UserBundle:Default:fournisseur.html.twig');
    }
    
    public function pharmacieIndexAction()
    {
        return $this->render('UserBundle:Default:pharmacie.html.twig');
    }
    
    public function clientIndexAction()
    {
        return $this->render('UserBundle:Default:client.html.twig');
    }
}
