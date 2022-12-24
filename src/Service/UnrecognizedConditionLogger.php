<?php

namespace App\Service;

use App\Factory\WeatherModelFactory;

/**
 * @phpstan-import-type OpenWeatherJsonCondition from WeatherModelFactory
 */
class UnrecognizedConditionLogger
{
    /**
     * @param OpenWeatherJsonCondition $condition
     */
    public function logUnrecognizedCondition(array $condition): void
    {
        // TODO
    }
}
