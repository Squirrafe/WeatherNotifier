<?php

namespace App\Model;

class Length
{
    public function __construct(
        private readonly float $meters,
    ) {
    }

    public function getMeters(): float
    {
        return $this->meters;
    }

    public function getKilometers(): float
    {
        return $this->meters / 1000.0;
    }

    public function getMiles(): float
    {
        return $this->meters / 1609.344;
    }

    public function getFeet(): float
    {
        return $this->meters / 0.3048;
    }

    public function getNauticalMiles(): float
    {
        return $this->meters / 1852;
    }
}
