<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $articles = $repo->findBy([],["id"=>"DESC"],15);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $this->createForm(ArticleType::class)->createView(),
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", methods={"POST"}, name="article_create")
     */

    public function create(Request $request)
    {
        $form = $this->createForm(ArticleType::class);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $article->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return new RedirectResponse($this->generateUrl("article_index"));
        }

        return $this->redirect('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $this->createForm(ArticleType::class)
        ]);

    }

    /**
     * @Route("/delete/{article}", name="article_delete", requirements={"article"="\d+"})
     */

    public function delete($article)
    {

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $el = $repository->find($article);

        if (!$article) {
            throw $this->createNotFoundException('No guest found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($el);
        $em->flush();

        return new RedirectResponse($this->generateUrl("article_index"));

    }


 }
