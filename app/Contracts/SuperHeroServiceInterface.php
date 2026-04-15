<?php

namespace App\Contracts;

use App\Models\HeroResult;
use App\Models\SearchResult;

interface SuperHeroServiceInterface
{
    public function findById(int $id): HeroResult;

    public function search(string $name): SearchResult;
}
