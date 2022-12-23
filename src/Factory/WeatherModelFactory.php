<?php

namespace App\Factory;

use App\Model\Weather;
use DateTimeImmutable;

readonly class WeatherModelFactory
{
    public function __construct(
        private WeatherConditionFactory $conditionFactory,
        private LengthFactory $lengthFactory,
        private TemperatureFactory $temperatureFactory,
        private SpeedFactory $speedFactory,
    ) {
    }

    public function buildFromOpenWeatherJson(array $json): Weather
    {
        return new Weather(
            (new DateTimeImmutable())->setTimestamp($json['dt']),
            $this->temperatureFactory->build($json['temp']),
            $this->temperatureFactory->build($json['feels_like']),
            $json['pressure'],
            $json['humidity'],
            $this->temperatureFactory->build($json['dew_point']),
            $json['uvi'] ?? null,
            $json['clouds'],
            $this->lengthFactory->buildNullable($json['visibility'] ?? null),
            $json['wind_deg'],
            $this->speedFactory->build($json['wind_speed']),
            $this->speedFactory->buildNullable($json['wind_gust'] ?? null),
            ($json['rain'] ?? [])['1h'] ?? null,
            ($json['snow'] ?? [])['1h'] ?? null,
            $this->conditionFactory->build($json['weather']),
        );
    }
}
