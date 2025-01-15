<?php

namespace App\Controller;

use App\Service\CacheService;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class GetImageController extends AbstractController
{
    public function __construct(
        private readonly CacheService $cacheService
    ) {
    }
    #[Route('/get-image', name: 'get_image')]
    public function __invoke(#[MapQueryParameter] string $prompt): Response
    {
        return $this->render('home/image.html.twig', [
            'src' => $this->cacheService->getGeneratedImageUrlFromPrompt($prompt)
        ]);
    }
}