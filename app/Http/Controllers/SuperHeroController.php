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
     * @param Request $request
     * @return View
     *
     * Return the retrieved Super Heroes matching a name query
     */
    public function index(Request $request): View
    {
        $superHeroes = SuperHeroService::search($request->input('search',"batman"));
        dd($superHeroes);
        return view('super-heroes.index',compact('superHeroes'));
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
