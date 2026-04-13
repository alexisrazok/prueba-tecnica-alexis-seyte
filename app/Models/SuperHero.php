<?php

namespace App\Models;

use Illuminate\Support\Collection;

class SuperHero
{
    public function __construct(
        public readonly string      $id,
        public readonly string      $name,
        public readonly PowerStats  $powerStats,
        public readonly Biography   $biography,
        public readonly Appearance  $appearance,
        public readonly Work        $work,
        public readonly Connections $connections,
        public readonly string      $imageUrl,
    )
    {
    }

    public static function parse(array|object $data): self|Collection
    {
        if (is_array($data)) {
            return collect($data)->map(fn($item) => self::parse($item));
        }
        return new self(
            id: $data->id,
            name: $data->name,
            powerStats: PowerStats::parse($data->powerstats),
            biography: Biography::parse($data->biography),
            appearance: Appearance::parse($data->appearance),
            work: Work::parse($data->work),
            connections: Connections::parse($data->connections),
            imageUrl: $data->image?->url ?? null,
        );
    }
}
