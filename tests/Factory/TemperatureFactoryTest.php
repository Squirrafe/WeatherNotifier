<?php

namespace App\Tests\Factory;

use App\Factory\TemperatureFactory;
use App\Model\Temperature;
use PHPUnit\Framework\TestCase;

class TemperatureFactoryTest extends TestCase
{
    private TemperatureFactory $temperatureFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->temperatureFactory = new TemperatureFactory();
    }

    /**
     * @dataProvider buildDataProvider
     * @param float|int|array{day: float|int} $input
     * @param Temperature $expected
     */
    public function testBuild(float|int|array $input, Temperature $expected): void
    {
        $temperature = $this->temperatureFactory->build($input);
        self::assertEquals($expected, $temperature);
    }

    /** @return iterable<array{input: float|int|array{day: float|int}, expected: Temperature}> */
    public function buildDataProvider(): iterable
    {
        yield [
            'input' => 150,
            'expected' => new Temperature(150.0),
        ];
        yield [
            'input' => 276.43,
            'expected' => new Temperature(276.43),
        ];
        yield [
            'input' => [
                'day' => 15,
                'night' => 30,
            ],
            'expected' => new Temperature(15.0),
        ];
    }
}
