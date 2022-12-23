<?php

namespace App\Util;

class Config
{
    public function __construct(
        public readonly string $openWeatherApiToken,
        public readonly string $openWeatherApiUrl,
    ) {
    }
}
