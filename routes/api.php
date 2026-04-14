<?php
use \App\Http\Controllers\SuperHeroController;

Route::name('api.')->group(function() {
    Route::get('/super-heroe', [SuperHeroController::class, 'index'])->name('super-hero.index');
    Route::get('/super-heroe/{id}', [SuperHeroController::class, 'show'])->name('super-hero.show');
});
