<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use BlogBundle\Entity\Post;

/**
 * @Route("/post")
 */

class PostController extends Controller
{
    public function serializePost(Post $post) {
        return array(
            'title' => $post->getTitle(),
            'body' => $post->getBody(),
            'user' => $post->getUser(),
            'tag' => $post->getTag(),
            'createAt' => $post->getCreateAt()
        );
    }
    
    /**
     * @Route("/getall", methods={"GET"})
     */
    public function getAllPostsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository(Post::class);

        $posts = $repository->findAll();

        $data = array('post' => array());

        foreach ($posts as $post) {
            $data['post'][] = $this->serializePost($post);
        }

        $response = new JsonResponse($data, 200);
        
        return $response;
    }
}
