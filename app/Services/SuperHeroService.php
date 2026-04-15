<?php

namespace App\Services;

use App\Contracts\SuperHeroRepositoryInterface;
use App\Contracts\SuperHeroServiceInterface;
use App\Models\HeroResult;
use App\Models\SearchResult;
use App\Models\SuperHero;

class SuperHeroService implements SuperHeroServiceInterface
{
    public function __construct(
        private SuperheroRepositoryInterface $repository
    )
    {
    }

    /**
     * @param int $id
     * @return SuperHero
     *
     * Get a Super Hero by existing SuperHero ID
     */
    public function findById(int $id): HeroResult
    {
        $result = $this->repository->findById($id);
        if ($result['response'] === 'error') {
            return new HeroResult(response: 'error', superHero:null, error: $result['error']);
        }
        $superHero = SuperHero::parse(json_decode(json_encode($result)));
        return new HeroResult(response:'true',superHero: $superHero);
    }

    /**
     * @param string $name
     * @return SearchResult
     *
     * Get a Super Hero SearchResult matching with $name
     */

    public function search(string $name): SearchResult
    {
        $result = $this->repository->searchByName($name);
        if ($result['response'] === 'error') {
            return new SearchResult(response: 'error', error: $result['error']);
        }
        $superHeroes = array_map(
            fn($hero) => Superhero::parse(json_decode(json_encode($hero))),
            $result['results']
        );

        return new SearchResult(response: 'success', superHeroes: $superHeroes);
    }
}
