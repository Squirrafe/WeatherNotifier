<?php

namespace App\Factory;

use App\Model\WeatherCondition;
use App\Service\UnrecognizedConditionLogger;

/**
 * @phpstan-import-type OpenWeatherJsonCondition from WeatherModelFactory
 */
class WeatherConditionFactory
{
    public function __construct(
        private readonly UnrecognizedConditionLogger $unrecognizedConditionLogger,
    ) {
    }

    /**
     * @param OpenWeatherJsonCondition[] $json
     * @return WeatherCondition[]
     */
    public function build(array $json): array
    {
        $result = [];
        foreach ($json as $entry) {
            if (($condition = $this->buildForEntry($entry)) !== null) {
                $result[] = $condition;
            }
        }
        return $result;
    }

    /**
     * @param OpenWeatherJsonCondition $json
     */
    private function buildForEntry(array $json): ?WeatherCondition
    {
        $id = $json['id'];
        $condition = WeatherCondition::tryFrom($id);

        if ($condition !== null) {
            return $condition;
        }

        $this->unrecognizedConditionLogger->logUnrecognizedCondition($json);
        return null;
    }
}
