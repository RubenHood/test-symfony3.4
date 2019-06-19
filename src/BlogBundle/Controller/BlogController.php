<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/name", name="name_")
 */

class BlogController extends Controller
{

    /**
     * @Route("/")
     */

    public function indexAction()
    {
        //cambiar esto que viene por default
        return $this->render('@Blog/Default/index.html.twig');
    }
}
