<?php

namespace App\Models;

class Connections
{
    public function __construct(
        public readonly string $groupAffiliation,
        public readonly string $relatives,
    )
    {
    }

    public static function parse(object $data): self
    {
        return new self(
            groupAffiliation: $data->{'group-affiliation'},
            relatives: $data->relatives,
        );
    }
}
