<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article/admin", name="article_admin")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function index(): Response
    {
        return $this->render('article_admin/index.html.twig', [
            'controller_name' => 'ArticleAdminController',
        ]);
    }

        /**
         * @Route("/admin/article/new",name="admin_article_new")
         * @IsGranted("ROLE_ADMIN_ARTICLE")
         */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        //this will execute only when form is submitted
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            dd($form->getData());
            /** @var Article $article */
            $article = $form->getData();
             $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article Created! Knowledge is power!');
//
            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('article_admin/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/article/{id}/edit", name="admin_article_edit")
     * @IsGranted("MANAGE", subject="article")
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ArticleFormType::class, $article,[
            'include_published_at'=>true,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');

            return $this->redirectToRoute('admin_article_edit', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('article_admin/edit.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/article/{id}/delete", name="admin_article_delete")
     * @IsGranted("MANAGE", subject="article")
     */
    public function delete(Article $article, Request $request, EntityManagerInterface $em)
    {
//        $form = $this->createForm(ArticleFormType::class, $article);
//
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em->persist($article);
//            $em->flush();
//
//            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');
//
//            return $this->redirectToRoute('admin_article_edit', [
//                'id' => $article->getId(),
//            ]);
//        }
//
//        return $this->render('article_admin/edit.html.twig', [
//            'articleForm' => $form->createView()
//        ]);
    }
    /**
     * @Route("/admin/article", name="admin_article_list")
     */
    public function list(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findBy([],['createdAt'=>'DESC']);

        return $this->render('article_admin/list.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/admin/article/location-select", name="admin_article_location_select")
     */
    public function getSpecificLocationSelect(Request $request)
    {
//        // a custom security check
//        if (!$this->isGranted('ROLE_ADMIN_ARTICLE') && $this->getUser()->getArticles()->isEmpty()) {
//            throw $this->createAccessDeniedException();
//        }

        $article = new Article();
        $article->setLocation($request->query->get('location'));
        $form = $this->createForm(ArticleFormType::class, $article);

        // no field? Return an empty response
        if (!$form->has('specificLocationName')) {
            return new Response(null, 204);
        }

        return $this->render('article_admin/_specific_location_name.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
}
