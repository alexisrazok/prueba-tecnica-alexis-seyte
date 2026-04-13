<?php

namespace App\Models;

class Appearance
{
    public function __construct(
        public readonly string $gender,
        public readonly string $race,
        public readonly string $heightImperial,
        public readonly string $heightMetric,
        public readonly string $weightImperial,
        public readonly string $weightMetric,
        public readonly string $eyeColor,
        public readonly string $hairColor,
    )
    {
    }

    public static function parse(object $data): self
    {
        return new self(
            gender: $data->gender,
            race: $data->race,
            heightImperial: $data->height[0] ?? 'N/A',
            heightMetric: $data->height[1] ?? 'N/A',
            weightImperial: $data->weight[0] ?? 'N/A',
            weightMetric: $data->weight[1] ?? 'N/A',
            eyeColor: $data->{'eye-color'},
            hairColor: $data->{'hair-color'},
        );
    }
}
