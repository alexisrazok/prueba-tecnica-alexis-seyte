<?php

namespace App\Interfaces;

interface SuperHeroInterface
{
    function findById(int $id);
    function search(string $name);
}
