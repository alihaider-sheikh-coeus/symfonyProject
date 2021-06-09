<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentAdminConrollerController extends AbstractController
{
    /**
     * @Route("/admin/comment", name="comment_admin")
     */
    public function index(CommentRepository $commentRepository,Request $request,CommentRepository $repository,PaginatorInterface $paginator): Response
    {
        $q = $request->query->get('q');
//        dump($q);
        $queryBuilder = $repository->getWithSearchQueryBuilder($q);
//        dump($queryBuilder);die();
        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
//        dump($pagination);die();

        return $this->render('comment_admin_conroller/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
