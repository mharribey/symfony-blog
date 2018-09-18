<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ArticleController extends AbstractController
{

    /**
     * @Route("/", methods={"GET"}, name="article_index")
     */

    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $this->createForm(ArticleType::class)->createView(),
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/", methods={"POST"}, name="article_create")
     */

    public function create(Request $request)
    {
        $form = $this->createForm(ArticleType::class);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render("article/index.html.twig", [
            'controller_name' => 'ArticleController',
            'form' => $this->createForm(ArticleType::class)->createView(),
        ]);

    }

 }
