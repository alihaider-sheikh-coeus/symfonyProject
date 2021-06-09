<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\service\MarkdownHelper;

use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

/**
 * @Route ("/",name="app_homepage")
*/
    public function homepage(ArticleRepository $repository ):Response
    {
//       $repo= $repository->getRepository(Article::class);
       $articles=$repository->findAllPublishedOrderedByNewest();
//        dump($articles);die();
        return $this->render('article/homepage.html.twig',['articles'=>$articles]);
    }
    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show(Article $article)
    {
        if ($article->getSlug() === 'khaaaaaan') {
//            $slack->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
        }

//        $comments = [
//            'I ate a normal rock once. It did NOT taste like bacon!',
//            'Woohoo! I\'m going on an all-asteroid diet!',
//            'I like bacon too! Buy some from my site! bakinsomebacon.com',
//        ];

        return $this->render('article/show.html.twig', [
            'article' => $article,
//            'comments' => $article->getComments(),
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush();

//        $logger->info('Article is being hearted!');

        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}
