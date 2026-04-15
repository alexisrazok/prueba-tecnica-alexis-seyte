<?php

namespace App\Contracts;

use App\Models\SuperHero;
use App\Models\SearchResult;

interface SuperHeroServiceInterface
{
    public function findById(int $id):?SuperHero;
    public function search(string $name): SearchResult;
}
