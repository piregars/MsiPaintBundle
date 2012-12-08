<?php

namespace Msi\Bundle\PaintBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MsiPaintBundle:Default:index.html.twig', array('name' => $name));
    }
}
