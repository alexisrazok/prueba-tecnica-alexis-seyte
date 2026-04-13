<?php

namespace App\Services;

use App\Interfaces\SuperHeroInterface;
use App\Models\SuperHero;
use Illuminate\Support\Collection;
use GuzzleHttp\Client;

class SuperHeroService implements SuperHeroInterface
{
    private const API_URL = "https://superheroapi.com/api/";

    /**
     * @param int $id
     * @return SuperHero
     *
     * Get a Super Hero by existing SuperHero ID
     */
    public static function findById(int $id):SuperHero
    {


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
            $baseUrl = self::API_URL . config('services.superhero.key');
            $client = new Client();
            $fetchUrl = $baseUrl."/search/" . $name;
            $request = $client->get($fetchUrl);
            if($request->getStatusCode()!==200){
                throw new \Exception("Error requesting data from API");
            }
            $response = $request->getBody();
            $responseContent = $response->getContents();
            $responseJson = json_decode($responseContent);
            if($responseJson->response!=="success"){
                throw new \Exception("Error getting response from API");
            }
            $results = $responseJson->results;
            return collect($results);
        }catch(\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
