<?php

namespace MimFrontBundle\Controller;

use MimFrontBundle\Entity\Category;
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

    /**
     * @Route("/category/{title}", name="category", defaults={"title" = "Default Title"})
     */
    public function categoryAction($title)
    {
        $category = new Category();
        is_string($title);
        $category->setTitle($title);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return $this->render('MimFrontBundle:Default:category.html.twig', array('title' => $title));
    }
}
