<?php

namespace App\Tests\Model;

use App\Model\Length;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-type DataProviderType array{
 *     meters: int|float,
 *     kilometers: int|float,
 *     miles: int|float,
 *     feet: int|float,
 *     nauticalMiles: int|float,
 * }
 */
class LengthTest extends TestCase
{
    public const ACCEPTABLE_DELTA = 0.01;

    /**
     * @dataProvider lengthDataProvider
     * @param DataProviderType $lengths
     */
    public function testGetMeters(array $lengths): void
    {
        $length = new Length($lengths['meters']);
        self::assertEqualsWithDelta($lengths['meters'], $length->getMeters(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider lengthDataProvider
     * @param DataProviderType $lengths
     */
    public function testGetKilometers(array $lengths): void
    {
        $length = new Length($lengths['meters']);
        self::assertEqualsWithDelta($lengths['kilometers'], $length->getKilometers(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider lengthDataProvider
     * @param DataProviderType $lengths
     */
    public function testGetMiles(array $lengths): void
    {
        $length = new Length($lengths['meters']);
        self::assertEqualsWithDelta($lengths['miles'], $length->getMiles(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider lengthDataProvider
     * @param DataProviderType $lengths
     */
    public function testGetFeet(array $lengths): void
    {
        $length = new Length($lengths['meters']);
        self::assertEqualsWithDelta($lengths['feet'], $length->getFeet(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider lengthDataProvider
     * @param DataProviderType $lengths
     */
    public function testGetNauticalMiles(array $lengths): void
    {
        $length = new Length($lengths['meters']);
        self::assertEqualsWithDelta($lengths['nauticalMiles'], $length->getNauticalMiles(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @return iterable<array{DataProviderType}>
     */
    public function lengthDataProvider(): iterable
    {
        yield [[
            'meters' => 0,
            'kilometers' => 0,
            'miles' => 0,
            'feet' => 0,
            'nauticalMiles' => 0,
        ]];
        yield [[
            'meters' => 100,
            'kilometers' => 0.1,
            'miles' => 0.06214,
            'feet' => 328.08399,
            'nauticalMiles' => 0.054,
        ]];
        yield [[
            'meters' => 1500,
            'kilometers' => 1.5,
            'miles' => 0.932056788,
            'feet' => 4921.25984,
            'nauticalMiles' => 0.8099,
        ]];
    }
}
