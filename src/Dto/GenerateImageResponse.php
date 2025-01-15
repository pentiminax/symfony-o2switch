<?php

namespace App\Dto;

readonly class GenerateImageResponse
{
    public function __construct(
        /** @var $urls string[] */
        public array $urls
    ) {}
}