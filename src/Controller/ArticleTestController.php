<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\RedisCacheService;
use Psr\Cache\InvalidArgumentException;
use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleTestController extends AbstractController
{
    /**
     * @param RedisCacheService $redisCacheService
     * @return Response
     * @throws InvalidArgumentException
     * @throws RandomException
     */
    #[Route('/test_articles', name: 'app_article_test', methods: ['GET'])]
    public function searchArticle(
        RedisCacheService $redisCacheService
    ): Response
    {
        $id = 1;
        $article = $redisCacheService->getCachedResults($id, Article::class);

        return new JsonResponse(json_decode($article, true) ?? []);
    }
}
