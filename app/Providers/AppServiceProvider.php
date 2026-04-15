<?php

namespace App\Providers;

use App\Contracts\SuperHeroRepositoryInterface;
use App\Contracts\SuperHeroServiceInterface;
use App\Repositories\SuperHeroRepository;
use App\Services\SuperHeroService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SuperheroRepositoryInterface::class,
            SuperHeroRepository::class
        );

        $this->app->bind(
            SuperheroServiceInterface::class,
            SuperheroService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
