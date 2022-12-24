<?php

namespace App\Tests\Model;

use App\Model\Temperature;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-type DataProviderType array{
 *     celsius: int|float,
 *     fahrenheit: int|float,
 *     kelvin: int|float,
 *     rankine: int|float,
 *     delisle: int|float,
 *     newton: int|float,
 *     reaumur: int|float,
 *     roemer: int|float,
 * }
 */
class TemperatureTest extends TestCase
{
    public const ACCEPTABLE_DELTA = 0.01;

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetKelvin(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['kelvin'], $temperature->getKelvin(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetCelsius(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['celsius'], $temperature->getCelsius(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetFahrenheit(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['fahrenheit'], $temperature->getFahrenheit(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetRankine(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['rankine'], $temperature->getRankine(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetDelisle(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['delisle'], $temperature->getDelisle(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetNewton(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['newton'], $temperature->getNewton(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetReaumur(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['reaumur'], $temperature->getReaumur(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider temperatureDataProvider
     * @param DataProviderType $degrees
     */
    public function testGetRoemer(array $degrees): void
    {
        $temperature = new Temperature($degrees['kelvin']);
        self::assertEqualsWithDelta($degrees['roemer'], $temperature->getRoemer(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @return iterable<array{DataProviderType}>
     */
    public function temperatureDataProvider(): iterable
    {
        yield [[
            'celsius' => 500,
            'fahrenheit' => 932,
            'kelvin' => 773.15,
            'rankine' => 1391.67,
            'delisle' => -600,
            'newton' => 165,
            'reaumur' => 400,
            'roemer' => 270,
        ]];
        yield [[
            'celsius' => 100,
            'fahrenheit' => 212,
            'kelvin' => 373.15,
            'rankine' => 671.67,
            'delisle' => 0,
            'newton' => 33,
            'reaumur' => 80,
            'roemer' => 60,
        ]];
        yield [[
            'celsius' => 20,
            'fahrenheit' => 68,
            'kelvin' => 293.15,
            'rankine' => 527.67,
            'delisle' => 120,
            'newton' => 6.60,
            'reaumur' => 16,
            'roemer' => 18,
        ]];
        yield [[
            'celsius' => 0,
            'fahrenheit' => 32,
            'kelvin' => 273.15,
            'rankine' => 491.67,
            'delisle' => 150,
            'newton' => 0,
            'reaumur' => 0,
            'roemer' => 7.5,
        ]];
        yield [[
            'celsius' => -14.29,
            'fahrenheit' => 6.278,
            'kelvin' => 258.86,
            'rankine' => 465.948,
            'delisle' => 171.43,
            'newton' => -4.71,
            'reaumur' => -11.43,
            'roemer' => 0,
        ]];
        yield [[
            'celsius' => -273.15,
            'fahrenheit' => -459.67,
            'kelvin' => 0.0,
            'rankine' => 0.0,
            'delisle' => 559.73,
            'newton' => -90.14,
            'reaumur' => -218.52,
            'roemer' => -135.90,
        ]];
    }
}
