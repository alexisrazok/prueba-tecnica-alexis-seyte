<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperHero extends Model
{
    protected $fillable = [
        "id",
        "name",
        "powerstats",
        "biography",
        "appearance",
        "work",
        "connections",
        "image"
    ];
}
