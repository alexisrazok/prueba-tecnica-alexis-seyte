<?php

namespace App\Services;

use App\Interfaces\SuperHeroInterface;
use App\Models\SuperHero;
use Illuminate\Support\Collection;

class SuperHeroService implements SuperHeroInterface
{
    private const API_URL = "https://superheroapi.com/api/";

    /**
     * @param int $id
     * @return SuperHero
     *
     * Get a Super Hero by existing SuperHero ID
     */
    function findById(int $id):SuperHero
    {


    }

    /**
     * @param string $name
     * @return Collection
     *
     * Get a Super Hero Collection matching with $name
     */

    function search(string $name): Collection
    {

    }
}
