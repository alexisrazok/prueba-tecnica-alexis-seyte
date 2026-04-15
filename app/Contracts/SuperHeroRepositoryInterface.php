<?php

namespace App\Contracts;

interface SuperHeroRepositoryInterface
{
    public function findById(int $id): ?array;

    public function searchByName(string $name): array;
}
