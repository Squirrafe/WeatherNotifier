<?php

namespace App\Tests\Factory;

use App\Factory\WeatherConditionFactory;
use App\Model\WeatherCondition;
use App\Service\UnrecognizedConditionLogger;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WeatherConditionFactoryTest extends TestCase
{
    private WeatherConditionFactory $factory;
    private MockObject|UnrecognizedConditionLogger $conditionLogger;

    protected function setUp(): void
    {
        parent::setUp();
        $this->conditionLogger = $this->createMock(UnrecognizedConditionLogger::class);
        $this->factory = new WeatherConditionFactory($this->conditionLogger);
    }

    /** @dataProvider buildDataProvider */
    public function testBuild(array $input, array $expected, array $logged): void
    {
        $this->conditionLogger
            ->expects($this->exactly(count($logged)))
            ->method('logUnrecognizedCondition')
            ->with(...$logged);

        $result = $this->factory->build($input);
        self::assertSame($expected, $result);
    }

    public function buildDataProvider(): iterable
    {
        yield [
            'input' => [
                [ 'id' => 211 ],
            ],
            'expected' => [ WeatherCondition::THUNDERSTORM ],
            'logged' => [],
        ];
        yield [
            'input' => [
                [ 'id' => 211 ],
                [ 'id' => 301 ],
            ],
            'expected' => [ WeatherCondition::THUNDERSTORM, WeatherCondition::DRIZZLE ],
            'logged' => [],
        ];
        yield [
            'input' => [
                [ 'id' => 211 ],
                [ 'id' => 623 ],
                [ 'id' => 301 ],
            ],
            'expected' => [ WeatherCondition::THUNDERSTORM, WeatherCondition::DRIZZLE ],
            'logged' => [
                [ 'id' => 623 ],
            ],
        ];
    }
}
