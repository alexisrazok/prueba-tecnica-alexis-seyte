<?php

namespace App\Services;

use App\Interfaces\SuperHeroInterface;
use App\Models\SuperHero;
use GuzzleHttp\Client;
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
    public static function findById(int $id): ?SuperHero
    {
        $baseUrl = self::API_URL . config('services.superhero.key');
        $fetchUrl = "{$baseUrl}/{$id}";
        try {
            $client = new Client();
            $request = $client->get($fetchUrl);
            if ($request->getStatusCode() !== 200) {
                throw new \Exception("Error requesting data from API");
            }
            $response = $request->getBody();
            $responseContent = $response->getContents();
            $responseJson = json_decode($responseContent);
            return SuperHero::parse($responseJson);
        } catch (\Exception $exception) {
            \Log::error('Superhero API error: ' . $exception->getMessage());
            return null;
        }
    }

    /**
     * @param string $name
     * @return Collection
     *
     * Get a Super Hero Collection matching with $name
     */

    public static function search(string $name): Collection
    {
        $baseUrl = self::API_URL . config('services.superhero.key');
        $fetchUrl = "{$baseUrl}/search/{$name}";
        try {
            $client = new Client();
            $request = $client->get($fetchUrl);
            if ($request->getStatusCode() !== 200) {
                throw new \Exception("Error requesting data from API");
            }
            $response = $request->getBody();
            $responseContent = $response->getContents();
            $responseJson = json_decode($responseContent);
            return SuperHero::parse($responseJson->results);
        } catch (\Exception $exception) {
            \Log::error('Superhero API error: ' . $exception->getMessage());
            return collect([]);
        }
    }
}
