<?php

namespace App\Repositories;

use App\Contracts\SuperHeroRepositoryInterface;
use App\Models\SuperHero;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SuperHeroRepository implements SuperHeroRepositoryInterface
{
    private const API_URL = "https://superheroapi.com/api/";
    private string $baseUrl;

    /**
     * Establish the connection to the API using token
     */
    public function __construct()
    {
        $token = config('services.superhero.key');
        $this->baseUrl = self::API_URL."{$token}";
    }

    public function findById(int $id): ?SuperHero
    {
        $response = $this->requestFromApi("/{$id}");
        if(!$response){
            return null;
        }
        return Superhero::parse($response);
    }

    public function searchByName(string $name): array
    {
        $response = $this->requestFromApi("/search/{$name}");
        if(!$response){
            return [];
        }
        return $response;
    }

    private function requestFromApi(string $endpoint): null|object|array
    {
        try {
            $response = Http::get("{$this->baseUrl}{$endpoint}");
            if ($response->failed()) {
                throw new \Exception('Error fetching data from SuperHeroApi:'.$endpoint);
            }
            return $response->json();
        }catch (\Exception $exception){
            Log::error("SuperHeroRepository error: {$exception->getMessage()}");
            return null;
        }
    }
}
