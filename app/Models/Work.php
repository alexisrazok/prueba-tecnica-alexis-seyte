<?php

namespace App\Models;

class Work
{
    public function __construct(
        public readonly string $occupation,
        public readonly string $base,
    )
    {
    }

    public static function parse(object $data): self
    {
        return new self(
            occupation: $data->occupation,
            base: $data->base,
        );
    }
}
