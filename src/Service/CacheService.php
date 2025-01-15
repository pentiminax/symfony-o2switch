<?php

namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;

readonly class CacheService
{
    public function __construct(
        private CacheItemPoolInterface $cache,
    ) {
    }

    public function saveGeneratedImageUrl(string $prompt, string $url): void
    {
        $key = $this->buildKey($prompt);
        $item = $this->cache->getItem($key);

        if (!$item->isHit()) {
            $item->set($url);
            $this->cache->save($item);
        }
    }

    public function getGeneratedImageUrlFromPrompt(string $prompt): ?string
    {
        $key = $this->buildKey($prompt);
        $item = $this->cache->getItem($key);

        return $item->get();
    }

    private function buildKey(string $prompt): string
    {
        return md5("image_$prompt");
    }
}