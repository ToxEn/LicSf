<?php

namespace MimFrontBundle\Controller;

use MimFrontBundle\Entity\Category;
use MimFrontBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home", defaults={"color" = "black"})
     * @param $color
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($color)
    {
        return $this->render('MimFrontBundle:Default:index.html.twig', array('color' => $color));
    }

    /**
     * @Route("/couleur/{color}", name="color", defaults={"color" = "black"})
     * @param $color
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function colorAction($color)
    {
        return $this->render('MimFrontBundle:Default:index.html.twig', array('color' => $color));
    }

    /**
     * @Route("/newCategory/{title}", name="newCategory", defaults={"title" = "Default Title"})
     * @param $title
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction($title)
    {
        $category = new Category();
        $category->setTitle($title);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return $this->render('MimFrontBundle:Default:category.html.twig', array('title' => $title));
    }

    /**
     * @Route("/newPost", name="newPost")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAction()
    {
        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle('Default category title');
        $postCategory = $em->getRepository('MimFrontBundle:Category')->findOneById(2);

        $post = new Post();
        $post->setTitle('Default post title');
        $post->setText('Lorem ipsum dolor sit amet.');
        $post->setDate(new \DateTime());
        $post->setEnable(1);
        $post->setCategory($postCategory);


        $postTitle = $post->getTitle();
        $postText = $post->getText();
        $postDate = $post->getDate()->format('d-M-Y');

        $em->persist($category);
        $em->persist($post);
        $em->flush();

        return $this->render('MimFrontBundle:Default:post.html.twig', array('postTitle' => $postTitle, 'postText' => $postText, 'postDate' => $postDate, 'postCategory' => $postCategory));
    }
}
