<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use BlogBundle\Entity\Post;

/**
 * @Route("/post")
 */

class PostController extends Controller
{
    
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        //recuperamos el entiti manager
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('BlogBundle:User');

        //Creamos usuario
        $user = $repository->find(1);

        //creamos la entidad
        $post = new Post();
        $post->setTitle("Prueba con Cristian");
        $post->setBody("Es el cuerpo");
        $post->setTag("untag");
        $post->setCreateAt(new \DateTime('now'));
        $post->setUser($user);

        //presistimos la entidad
        $em->persist($post);
        $em->flush();

        return new Response("Retorno post creado ->" . $post->getId());
    }

    /**
     * @Route("/getAll")
     */
    public function getAllAction()
    {

        //recuperamos el entiti manager
        $em = $this->getDoctrine()->getManager();

        //obtenemos la referencia al repositorio
        $repository = $em->getRepository("BlogBundle:Post");

        $posts = $repository->findAll();

        return $this->render("@Blog/Default/Posts.html.twig", ["posts" => $posts]);
    }

    /**
     * @Route("/find/{id}")
     */
    public function getPostById($id)
    {

        //recuperamos el entiti manager
        $em = $this->getDoctrine()->getManager();

        //obtenemos la referencia al repositorio
        $repository = $em->getRepository("BlogBundle:Post");

        $post = $repository->find($id);

        return $this->render("@Blog/Default/formpost.html.twig", ["post" => $post]);
    }

    /**
     * @Route("/update/{id}")
     */
    public function updatePost($id)
    {

        //recuperamos el entiti manager
        $em = $this->getDoctrine()->getManager();

        //obtenemos la referencia al repositorio
        $repository = $em->getRepository("BlogBundle:Post");

        $post = $repository->find($id);

        $post->setTitle("sadfasdf");
        $post->setBody("asfasdf");
        $post->setTag("asdfsadf");
        $post->setCreateAt(new \DateTime('now'));
        $post->setIduser(1);

        //presistimos la entidad
        $em->flush();

        //mandamos a mostrar todos los posts
        return $this->redirect('/blog/post/getAll');
    }

    /**
     * @Route("/findtitle/{title}")
     */
    public function findByTitle($title)
    {

        //recuperamos el entiti manager
        $em = $this->getDoctrine()->getManager();

        //obtenemos la referencia al repositorio
        $repository = $em->getRepository("BlogBundle:Post");

        $posts = $repository->findByTitle($title);

        return $this->render("@Blog/Default/Posts.html.twig", ["posts" => $posts]);
    }

    /**
     * @Route("/findquery/{title}")
     */
    public function findByQuery($title)
    {

        //recuperamos el entiti manager
        $em = $this->getDoctrine()->getManager();

        //obtenemos la referencia al repositorio
        $repository = $em->getRepository("BlogBundle:Post");

        //creamos la query
        $query = $repository->createQueryBuilder('a')
                    ->where('a.title LIKE :title')
                    ->setParameter('title','%'.$title.'%')
                    ->getQuery();

        $posts = $query->getResult();

        return $this->render("@Blog/Default/Posts.html.twig", ["posts" => $posts]);
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deletePost($id)
    {

        //recuperamos el entiti manager
        $em = $this->getDoctrine()->getManager();

        //obtenemos la referencia al repositorio
        $repository = $em->getRepository("BlogBundle:Post");

        //buscamos el post
        $post = $repository->find($id);

        //eliminamos y actualizamos
        $em->remove($post);
        $em->flush();

        //mandamos a mostrar todos los posts
        return $this->redirect('/blog/post/getAll');
    }
    
}
