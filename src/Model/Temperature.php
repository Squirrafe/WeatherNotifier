<?php

namespace App\Model;

class Temperature
{
    public function __construct(
        private readonly float $kelvin,
    ) {
    }

    public function getKelvin(): float
    {
        return $this->kelvin;
    }

    public function getCelsius(): float
    {
        return $this->kelvin - 273.15;
    }

    public function getFahrenheit(): float
    {
        return $this->kelvin * 1.8 - 459.67;
    }

    public function getRankine(): float
    {
        return $this->kelvin * 1.8;
    }

    public function getDelisle(): float
    {
        return (373.15 - $this->kelvin) * 1.5;
    }

    public function getNewton(): float
    {
        return ($this->kelvin - 273.15) * 0.33;
    }

    public function getReaumur(): float
    {
        return ($this->kelvin - 273.15) * 0.8;
    }

    public function getRoemer(): float
    {
        return ($this->kelvin - 273.15) * (21.0 / 40.0) + 7.5;
    }
}
