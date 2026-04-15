<?php

namespace App\Models;

class HeroResult
{
    public function __construct(
        public readonly string $response,
        public readonly ?SuperHero $superHero,
        public readonly ?string $error = null,
    ) {}
}
