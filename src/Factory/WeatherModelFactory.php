<?php

namespace App\Factory;

use App\Model\Weather;
use DateTimeImmutable;

/**
 * @phpstan-type OpenWeatherJsonFull array{
 *   current: OpenWeatherJsonEntry,
 *   hourly: OpenWeatherJsonEntry[],
 *   daily: OpenWeatherJsonEntry[],
 * }
 *
 * @phpstan-type OpenWeatherJsonEntry array{
 *     dt: int,
 *     temp: int|float|array{day: int|float},
 *     feels_like: int|float|array{day: int|float},
 *     dew_point: int|float|array{day: int|float},
 *     uvi?: int|float|null,
 *     pressure: int|float,
 *     humidity: int|float,
 *     clouds: int|float,
 *     visibility?: int|float|null,
 *     wind_deg: int|float,
 *     wind_speed: int|float,
 *     wind_gust?: int|float|null,
 *     rain?: array{"1h": int|float|null}|null,
 *     snow?: array{"1h": int|float|null}|null,
 *     weather: OpenWeatherJsonCondition[],
 * }
 *
 * @phpstan-type OpenWeatherJsonCondition array{
 *     id: int,
 *     main: string,
 *     description: string,
 *     icon: string,
 * }
 */

readonly class WeatherModelFactory
{
    public function __construct(
        private WeatherConditionFactory $conditionFactory,
        private LengthFactory $lengthFactory,
        private TemperatureFactory $temperatureFactory,
        private SpeedFactory $speedFactory,
    ) {
    }

    /**
     * @param OpenWeatherJsonEntry $json
     */
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
