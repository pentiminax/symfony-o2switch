<?php

namespace App\MessageHandler;

use App\Message\GenerateImageMessage;
use App\Service\OpenAIService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GenerateImageMessageHandler
{
    public function __construct(
        private OpenAIService $openAIService
    ) {
    }

    public function __invoke(GenerateImageMessage $message): void
    {
        $urls = $this->openAIService->generateImage($message->prompt);
    }
}