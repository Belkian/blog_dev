<?php

namespace App\Controller\API;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/api/articles', name: 'api_article_')]
class ArticleController extends AbstractController {

    #[Route('', name:"index", methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): JsonResponse {

        $articles = $articleRepository->findAll();
        return $this->json($articles, 200, [], [
            'groups' => ['article.index']
        ]);
    }

    #[Route('/{id}', name:"show", requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function show(ArticleRepository $articleRepository, $id): JsonResponse {

        $article = $articleRepository->find($id);
        return $this->json($article, 200, [], [
            'groups' => ['article.index', 'article.show']       
        ]);
    }
}
