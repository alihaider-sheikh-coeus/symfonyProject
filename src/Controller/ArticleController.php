<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
/**
 * @Route ("/",name="")
*/
    public function homepage():Response
    {
        return new Response("first route");
    }
    /**
     * @Route ("/news/{slug}",name="")
     */
    public function show($slug)
    {
        return new Response("future page to show article ".$slug);
    }
}
