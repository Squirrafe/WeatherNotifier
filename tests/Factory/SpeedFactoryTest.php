<?php

namespace App\Tests\Factory;

use App\Factory\SpeedFactory;
use App\Model\Speed;
use PHPUnit\Framework\TestCase;

class SpeedFactoryTest extends TestCase
{
    private SpeedFactory $speedFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->speedFactory = new SpeedFactory();
    }

    /** @dataProvider buildDataProvider */
    public function testBuild(float|int $input, Speed $expected): void
    {
        $speed = $this->speedFactory->build($input);
        self::assertEquals($expected, $speed);
    }

    /** @dataProvider buildNullableDataProvider */
    public function testBuildNullable(float|int|null $input, ?Speed $expected): void
    {
        $speed = $this->speedFactory->buildNullable($input);
        self::assertEquals($expected, $speed);
    }

    /** @return iterable<array{input: int|float, expected: Speed}> */
    public function buildDataProvider(): iterable
    {
        yield [
            'input' => 15.0,
            'expected' => new Speed(15.0),
        ];
        yield [
            'input' => 30,
            'expected' => new Speed(30.0),
        ];
    }

    /** @return iterable<array{input: int|float|null, expected: Speed|null}> */
    public function buildNullableDataProvider(): iterable
    {
        yield from $this->buildDataProvider();

        yield [
            'input' => null,
            'expected' => null,
        ];
    }
}
