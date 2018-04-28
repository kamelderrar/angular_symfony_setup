<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/home")
 * Class HomeController
 * @package AppBundle\Controller
 */
class HomeController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $number = mt_rand(0, 100);
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();;
        return new JsonResponse([
            'number'=> $number,
            'posts' => $posts
        ]);
    }
}