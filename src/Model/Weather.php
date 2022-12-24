<?php

namespace App\Model;

use DateTimeImmutable;

class Weather
{
    /**
     * @param WeatherCondition[] $weatherConditions
     */
    public function __construct(
        public readonly DateTimeImmutable $timestamp,
        public readonly Temperature $temperature,
        public readonly Temperature $feelsLike,
        public readonly float $pressure,
        public readonly float $humidity,
        public readonly Temperature $dewPoint,
        public readonly ?float $uvi,
        public readonly float $clouds,
        public readonly ?Length $visibility,
        public readonly float $windDegrees,
        public readonly Speed $windSpeed,
        public readonly ?Speed $windGust,
        public readonly ?float $lastHourRain,
        public readonly ?float $lastHourSnow,
        public readonly array $weatherConditions,
    ) {
    }
}
