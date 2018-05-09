<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package AppBundle\Controller
 * @Route("/posts")
 */
class PostController extends Controller
{
    /**
     *
     * @Route("/all", name="gets_posts")
     * @Method("GET")
     */
    public function getPostsAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        $posts = $this->getSerializedData($posts);

        return new Response($posts);
    }

    /**
     * Serialize les données d'un tableau et retourne un json
     * @param $data
     * @return string
     */
    protected function getSerializedData($data)
    {
        $serializer = $this->get('jms_serializer');
        return $serializer->serialize($data, 'json');
    }
}