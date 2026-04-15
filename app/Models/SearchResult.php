<?php

namespace App\Models;

class SearchResult
{
    public function __construct(
        public readonly string $response,
        public readonly array  $superHeroes = [],
        public readonly ?string $error = null,
    ) {}
}
