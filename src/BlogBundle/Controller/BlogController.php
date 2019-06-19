<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use BlogBundle\Entity\Post;

class BlogController extends Controller
{

    /**
     * @Route("/add")
     */

    public function addAction()
    {
        
        //recuperamos el entiti manager
       $em = $this->getDoctrine()->getManager();

       //creamos la entidad
       $post = new Post();
       $post->setTitle("Prueba");
       $post->setBody("Es el cuerpo");
       $post->setTag("untag");
       $post->setCreateAt(\Date::now());
       $post->setIduser(1);

       //presistimos la entidad
       $em->persist($post);
       $em->flush();
       
       return new Response("Retorno post creado ->".$post->getId());
    }
}
