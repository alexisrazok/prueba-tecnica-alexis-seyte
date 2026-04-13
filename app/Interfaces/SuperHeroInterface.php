<?php

namespace App\Interfaces;

interface SuperHeroInterface
{
    public static function findById(int $id);
    public static function search(string $name);
}
