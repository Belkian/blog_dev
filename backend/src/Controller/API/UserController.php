<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class UserController extends AbstractController {
    #[Route('/api/users', name:"index")]
    public function index(UserRepository $repository): JsonResponse {

        $article = $repository->findAll();
        return $this->json($article, 200, [], [
            'groups' => ['admin.users.index']
        ]);
    }

    #[Route('/api/users/{id}', name:"show", requirements: ['id' => Requirement::DIGITS])]
    public function show(User $user): JsonResponse {

        return $this->json($user, 200, [], [
            'groups' => ['admin.users.index', 'user.dashboard']
        ]);
    }
}