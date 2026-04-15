<?php

namespace App\Models;

class Biography
{
    public function __construct(
        public readonly string $fullName,
        public readonly string $alterEgos,
        public readonly array  $aliases,
        public readonly string $placeOfBirth,
        public readonly string $firstAppearance,
        public readonly string $publisher,
        public readonly string $alignment,
    )
    {
    }

    public static function parse(object $data): self
    {
        return new self(
            fullName: $data->{'full-name'},
            alterEgos: $data->{'alter-egos'},
            aliases: (array)$data->aliases,
            placeOfBirth: $data->{'place-of-birth'},
            firstAppearance: $data->{'first-appearance'},
            publisher: $data->publisher,
            alignment: $data->alignment,
        );
    }
}
