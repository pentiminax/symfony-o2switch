<?php

namespace App\Service;

use App\Dto\GenerateImageResponse;
use OpenAI\Client;

class OpenAIService
{
    private Client $client;

    public function __construct()
    {
        $this->client = \OpenAI::client(
            apiKey: $_ENV['OPENAI_API_KEY']
        );
    }

    public function generateImage(string $prompt): string
    {
        $response = $this->client->images()->create([
            'model' => 'dall-e-2',
            'prompt' => $prompt,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        return $response->data[0]->url;
    }
}