<?php
use \App\Http\Controllers\SuperHeroController;

Route::name('api.')->group(function() {
    Route::get('/super-hero', [SuperHeroController::class, 'index'])->name('super-hero.index');
    Route::get('/super-hero/{id}', [SuperHeroController::class, 'show'])->name('super-hero.show');
});
