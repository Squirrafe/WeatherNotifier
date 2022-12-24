<?php

namespace App\Factory;

use App\Model\Temperature;

class TemperatureFactory
{
    /**
     * @param float|int|array{day: float|int} $temperature
     */
    public function build(float|int|array $temperature): Temperature
    {
        if (is_array($temperature)) {
            $temperature = $temperature['day'];
        }

        return new Temperature($temperature);
    }
}
