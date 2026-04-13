<?php

namespace App\Models;

class PowerStats
{
    public function __construct(
        public readonly int $intelligence,
        public readonly int $strength,
        public readonly int $speed,
        public readonly int $durability,
        public readonly int $power,
        public readonly int $combat,
    )
    {
    }

    public static function parse(object $data): self
    {
        return new self(
            intelligence: (int)$data->intelligence,
            strength: (int)$data->strength,
            speed: (int)$data->speed,
            durability: (int)$data->durability,
            power: (int)$data->power,
            combat: (int)$data->combat,
        );
    }
}
