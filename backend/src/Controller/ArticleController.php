<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/articles')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        $articlesDetails = [];
        foreach ($articles as $article) {

            $categoryNames = [];
            foreach ($article->getCategories() as $category) {
                $categoryNames[] = $category->getName();
            }

            $articlesDetails[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'image' => $article->getImage(),
                'text' => $article->getText(),
                'status' => $article->isStatus(),
                'creator' => $article->getCreator()->getName().' '.$article->getCreator()->getlastname(),
                'categories' => $categoryNames,
                'createdAt' => $article->getCreatedAt()->format('d/m/Y H:i'),
            ];
        }

        return $this->render('article/index.html.twig', [
            'articles' => $articlesDetails,
        ]);
    }

    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/accepter/{id}', name: 'app_article_accepter')]
    public function accepter(Article $article, EntityManagerInterface $entityManager): Response
    {
        if (!$article) {
            throw new NotFoundHttpException('Article non trouvé');
        }

        $article->setStatus(1);
        $entityManager->flush();

        $this->addFlash('success', 'L\'article a été approuvé avec succès.');

        return $this->redirectToRoute('app_dashboard');
    }

    #[Route('/refuser/{id}', name: 'app_article_refuser')]
    public function refuser(Article $article, EntityManagerInterface $entityManager): Response
    {
        if (!$article) {
            throw new NotFoundHttpException('Article non trouvé');
        }

        $entityManager->remove($article);
        $entityManager->flush();

        $this->addFlash('success', 'L\'article a été refusé et supprimé avec succès.');
        
        return $this->redirectToRoute('app_dashboard');
    }

}
