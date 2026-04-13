<?php

namespace App\Http\Controllers;

use App\Models\SuperHero;
use App\Services\SuperHeroService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperHeroController extends Controller
{
    /**
     * @return View
     *
     * Show the Super Hero Index view
     */
    public function index() : View
    {
        return view('super-heroes.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * Return the retrieved Super Heroes matching a name query
     */
    public function search(Request $request): JsonResponse
    {
        $superHeroes = SuperHeroService::search($request);
        return response()->json($superHeroes);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * Return the retrieved existing Super Hero by ID
     */
    public function show(Request $request)
    {
        $superHero = SuperHeroService::findById($request->param('id',null));
        return response()->json($superHero);
    }
}
