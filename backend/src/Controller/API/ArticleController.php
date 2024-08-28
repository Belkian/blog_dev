<?php

namespace App\Controller\API;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class ArticleController extends AbstractController {

    #[Route('/api/articles', name:"index")]
    public function index(ArticleRepository $repository): JsonResponse {

        $article = $repository->findAll();
        return $this->json($article, 200, [], [
            'groups' => ['article.index']
        ]);
    }

    #[Route('/api/articles/{id}', name:"show", requirements: ['id' => Requirement::DIGITS])]
    public function show(Article $article): JsonResponse {

        return $this->json($article, 200, [], [
            'groups' => ['article.index', 'article.show']
        ]);
    }
}