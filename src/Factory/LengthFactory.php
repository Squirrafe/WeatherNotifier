<?php

namespace App\Factory;

use App\Model\Length;

class LengthFactory
{
    public function build(float|int $length): Length
    {
        return new Length($length);
    }

    public function buildNullable(float|int|null $length): ?Length
    {
        return $length === null ? null : new Length($length);
    }
}
