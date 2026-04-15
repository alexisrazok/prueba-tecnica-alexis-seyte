<?php

namespace App\Services;

use App\Interfaces\SuperHeroInterface;
use App\Models\SuperHero;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
        try {
            $responseJson = self::getDataFromEndpoint("{$id}");
            if (!$responseJson) {
                return null;
            }
            return SuperHero::parse($responseJson);
        } catch (\Exception $exception) {
            Log::error('Superhero API error: ' . $exception->getMessage());
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
        try {
            $responseJson = self::getDataFromEndpoint("search/{$name}");
            if (!$responseJson || !isset($responseJson->results)) {
                return collect([]);
            }
            return SuperHero::parse($responseJson->results);
        } catch (\Exception $exception) {
            Log::error('Superhero API error: ' . $exception->getMessage());
            return collect([]);
        }
    }

    /**
     * @param string $endpoint
     * @return array|object|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * Retrieve the requested data from an endpoint
     */

    private static function getDataFromEndpoint(string $endpoint): null|array|object
    {
        try {
            $token = config('services.superhero.key');
            $endpointUrl = self::API_URL . "{$token}/{$endpoint}";
            $client = new Client();
            $request = $client->get($endpointUrl);
            if ($request->getStatusCode() !== 200) {
                throw new \Exception("Error requesting data from API");
            }
            $response = $request->getBody();
            $responseContent = $response->getContents();
            return json_decode($responseContent);
        } catch (\Exception $exception) {
            Log::error('Superhero API Request error: ' . $exception->getMessage());
            return null;
        }
    }
}
