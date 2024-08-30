<?php

namespace App\Controller\API;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/api/article', name: 'api_article_')]
class ArticleController extends AbstractController
{

    #[Route('s', name: "api_article_index", methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): JsonResponse
    {
        $articles = $articleRepository->findAll();
        foreach ($articles as $article) {
            $categories = $article->getCategories()->map(function($category) {
                return ['name' => $category->getName()];
            })->toArray();
            $responseData[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'text' => $article->getText(),
                'image' => $article->getImage(),
                'categories' => $categories,
                'creator' => $article->getCreator()->getName() . ' ' . $article->getCreator()->getlastname(),
                'date' => $article->getCreatedAt()->format('d/m/Y H:i'),
            ];
        }
        return $this->json($responseData, 200, [], [
            'groups' => ['api_article_index', 'api_article_show']
        ]);
    }

    #[Route('/{id}', name: "show", requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function show(ArticleRepository $articleRepository, $id): JsonResponse
    {
        $article = $articleRepository->find($id);
        return $this->json($article, 200, [], [
            'groups' => ['api_article_index', 'api_article_show']
        ]);
    }

    #[Route('/new', name: "new", methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->json($article, 201, [], [
                'groups' => ['api_article_index', 'api_article_show', 'api_article_new']
            ]);
        }

        return $this->json([
            'error' => 'Invalid request',
            'errors' => $form->getErrors()
        ], 400);
    }
}

