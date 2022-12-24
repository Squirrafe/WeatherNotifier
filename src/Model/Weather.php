<?php

namespace App\Model;

use DateTimeImmutable;

readonly class Weather
{
    /**
     * @param WeatherCondition[] $weatherConditions
     */
    public function __construct(
        public DateTimeImmutable $timestamp,
        public Temperature $temperature,
        public Temperature $feelsLike,
        public float $pressure,
        public float $humidity,
        public Temperature $dewPoint,
        public ?float $uvi,
        public float $clouds,
        public ?Length $visibility,
        public float $windDegrees,
        public Speed $windSpeed,
        public ?Speed $windGust,
        public ?float $lastHourRain,
        public ?float $lastHourSnow,
        public array $weatherConditions,
    ) {
    }
}
