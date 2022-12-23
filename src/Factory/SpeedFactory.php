<?php

namespace App\Factory;

use App\Model\Speed;

class SpeedFactory
{
    public function build(int|float $speed): Speed
    {
        return new Speed($speed);
    }

    public function buildNullable(int|float|null $speed): ?Speed
    {
        return $speed === null ? null : new Speed($speed);
    }
}
