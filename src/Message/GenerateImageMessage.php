<?php

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage(transport: 'async')]
readonly class GenerateImageMessage
{
    public function __construct(
        public string $prompt
    ) {
    }
}