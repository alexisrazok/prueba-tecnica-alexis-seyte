<?php

namespace App\Contracts;

use App\Models\SuperHero;

interface SuperHeroRepositoryInterface
{
    public function findById(int $id):?SuperHero;
    public function searchByName(string $name): array;
}
