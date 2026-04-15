<?php

namespace App\Http\Controllers;

use App\Contracts\SuperHeroServiceInterface;
use App\Http\Requests\SuperHeroSearchFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SuperHeroController extends Controller
{
    /**
     * @param SuperHeroServiceInterface $service
     *
     * Provide the service to the controller abstracting the service implementation
     */
    public function __construct(
        private SuperheroServiceInterface $service
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * Return the retrieved Super Heroes matching a name query
     */
    public function index(SuperHeroSearchFormRequest $request): JsonResponse
    {
        try {
            $superHeroes = null;
            if ($request->filled('search')) {
                $superHeroes = $this->service->search($request->input('search'));
            }
            return response()->json($superHeroes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * Return the retrieved existing Super Hero by ID
     */
    public function show(int $id): JsonResponse
    {
        try {
            $superHero = $this->service->findById($id);
            return response()->json($superHero);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
