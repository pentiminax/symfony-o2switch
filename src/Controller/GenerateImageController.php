<?php

namespace App\Controller;

use App\Dto\SendEmailRequest;
use App\Service\CacheService;
use App\Service\OpenAIService;
use OpenAI\Client;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class GenerateImageController extends AbstractController
{
    public function __construct(
        private readonly CacheService $cacheService,
        private readonly OpenAIService $openAIService
    ) {
    }

    #[Route('/generate-image', name: 'generate_image')]
    public function __invoke(MessageBusInterface $bus, #[MapQueryParameter] string $prompt): Response
    {
        $url = $this->openAIService->generateImage($prompt);

        $this->cacheService->saveGeneratedImageUrl($prompt, $url);

        return $this->redirectToRoute('home.index');
    }
}