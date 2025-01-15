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
        sleep(5);

        $url = "https://oaidalleapiprodscus.blob.core.windows.net/private/org-SU8Uf0LxNx3WDfOnbsIUQjwZ/user-HsogHPVNZbLED4mVCRoBFSdv/img-Mp3KAZLsTKkOEGLG3ylHPbrE.png?st=2025-01-15T09%3A12%3A06Z&se=2025-01-15T11%3A12%3A06Z&sp=r&sv=2024-08-04&sr=b&rscd=inline&rsct=image/png&skoid=d505667d-d6c1-4a0a-bac7-5c84a87759f8&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-01-15T00%3A12%3A56Z&ske=2025-01-16T00%3A12%3A56Z&sks=b&skv=2024-08-04&sig=25YIj4s%2BsfW5VN3Rkn9WXN8xU/dZZwkS3ySPVh57cv4%3D";

        //$url = $this->openAIService->generateImage($message->prompt);

        $this->cacheService->saveGeneratedImageUrl($message->prompt, $url);
    }
}