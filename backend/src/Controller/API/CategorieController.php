<?php

namespace App\Controller\API;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class CategorieController extends AbstractController
{
    #[Route('/api/categories', name: "api_categorie_index", methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): JsonResponse
    {
        $categories = $categorieRepository->findAll();
        return $this->json($categories, 200, [], [
            'groups' => ['api_categorie_index']
        ]);
    }

    #[Route('/api/categorie/{id}', name: "api_categorie_show", requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function show(Categorie $categorie): JsonResponse
    {
        return $this->json($categorie, 200, [], [
            'groups' => ['api_categorie_index', 'api_categorie_show']
        ]);
    }
}
