<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuperHeroSearchFormRequest;
use App\Services\SuperHeroService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperHeroController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * Return the retrieved Super Heroes matching a name query
     */
    public function index(SuperHeroSearchFormRequest $request): JsonResponse
    {
        $superHeroes = null;
        if($request->filled('search')){
            $superHeroes = SuperHeroService::search($request->input('search'));
        }
        return response()->json($superHeroes);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * Return the retrieved existing Super Hero by ID
     */
    public function show(int $id)
    {
        $superHero = SuperHeroService::findById($id);
        return response()->json($superHero);
    }
}
