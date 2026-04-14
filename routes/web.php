<?php
use \App\Http\Controllers\SuperHeroController;

Route::any('/{any}', function (){
    return view('app');
})->where('any', '.*');
