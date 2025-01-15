<?php

namespace App\MessageHandler;

use App\Message\GenerateImageMessage;
use App\Service\CacheService;
use App\Service\OpenAIService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GenerateImageMessageHandler
{
    public function __construct(
        private CacheService $cacheService,
        private OpenAIService $openAIService
    ) {
    }

    public function __invoke(GenerateImageMessage $message): void
    {
        $url = $this->openAIService->generateImage($message->prompt);

        $this->cacheService->saveGeneratedImageUrl($message->prompt, $url);
    }
}