<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'page_name' => 'Home'
        ]);
    }

    public function show(){
        return $this->render('article/show.html.twig', [
            'controller_name' => 'ArticleController'
        ]);
    }


}
