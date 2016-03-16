<?php

namespace MimFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home", defaults={"color" = "black"})
     */
    public function indexAction($color)
    {
        return $this->render('MimFrontBundle:Default:index.html.twig', array('color' => $color));
    }

    /**
     * @Route("/couleur/{color}", name="color", defaults={"color" = "black"})
     */
    public function colorAction($color)
    {
        return $this->render('MimFrontBundle:Default:index.html.twig', array('color' => $color));
    }
}
