<?php

namespace App\Tests\Model;

use App\Model\Speed;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-type DataProviderType array{
 *     metersPerSecond: int|float,
 *     kilometersPerHour: int|float,
 *     milesPerHour: int|float,
 *     feetPerSecond: int|float,
 *     knots: int|float,
 * }
 */
class SpeedTest extends TestCase
{
    public const ACCEPTABLE_DELTA = 0.01;

    /**
     * @dataProvider speedDataProvider
     * @param DataProviderType $speeds
     */
    public function testGetMetersPerSecond(array $speeds): void
    {
        $speed = new Speed($speeds['metersPerSecond']);
        self::assertEqualsWithDelta($speeds['metersPerSecond'], $speed->getMetersPerSecond(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider speedDataProvider
     * @param DataProviderType $speeds
     */
    public function testGetKilometersPerHour(array $speeds): void
    {
        $speed = new Speed($speeds['metersPerSecond']);
        self::assertEqualsWithDelta(
            $speeds['kilometersPerHour'],
            $speed->getKilometersPerHour(),
            self::ACCEPTABLE_DELTA,
        );
    }

    /**
     * @dataProvider speedDataProvider
     * @param DataProviderType $speeds
     */
    public function testGetMilesPerHour(array $speeds): void
    {
        $speed = new Speed($speeds['metersPerSecond']);
        self::assertEqualsWithDelta($speeds['milesPerHour'], $speed->getMilesPerHour(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider speedDataProvider
     * @param DataProviderType $speeds
     */
    public function testGetFeetPerSecond(array $speeds): void
    {
        $speed = new Speed($speeds['metersPerSecond']);
        self::assertEqualsWithDelta($speeds['feetPerSecond'], $speed->getFeetPerSecond(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @dataProvider speedDataProvider
     * @param DataProviderType $speeds
     */
    public function testGetKnots(array $speeds): void
    {
        $speed = new Speed($speeds['metersPerSecond']);
        self::assertEqualsWithDelta($speeds['knots'], $speed->getKnots(), self::ACCEPTABLE_DELTA);
    }

    /**
     * @return iterable<array{DataProviderType}>
     */
    public function speedDataProvider(): iterable
    {
        yield [[
            'metersPerSecond' => 0,
            'kilometersPerHour' => 0,
            'milesPerHour' => 0,
            'feetPerSecond' => 0,
            'knots' => 0,
        ]];
        yield [[
            'metersPerSecond' => 1.0,
            'kilometersPerHour' => 3.6,
            'milesPerHour' => 2.2369,
            'feetPerSecond' => 3.2808,
            'knots' => 1.944,
        ]];
        yield [[
            'metersPerSecond' => 5.0,
            'kilometersPerHour' => 18.0,
            'milesPerHour' => 11.18468,
            'feetPerSecond' => 16.4041995,
            'knots' => 9.719,
        ]];
    }
}
