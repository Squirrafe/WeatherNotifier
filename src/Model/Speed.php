<?php

namespace App\Model;

class Speed
{
    public function __construct(
        private readonly float $metersPerSecond,
    ) {
    }

    public function getMetersPerSecond(): float
    {
        return $this->metersPerSecond;
    }

    public function getKilometersPerHour(): float
    {
        return $this->metersPerSecond * 3.6;
    }

    public function getMilesPerHour(): float
    {
        return $this->metersPerSecond * 2.236936;
    }

    public function getKnots(): float
    {
        return $this->metersPerSecond * 1.943844;
    }

    public function getFeetPerSecond(): float
    {
        return $this->metersPerSecond * 3.28084;
    }
}
