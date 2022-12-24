<?php

namespace App\Tests\Factory;

use App\Factory\WeatherConditionFactory;
use App\Factory\WeatherModelFactory;
use App\Model\WeatherCondition;
use App\Service\UnrecognizedConditionLogger;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-import-type OpenWeatherJsonCondition from WeatherModelFactory
 */
class WeatherConditionFactoryTest extends TestCase
{
    private WeatherConditionFactory $factory;
    private MockObject&UnrecognizedConditionLogger $conditionLogger;

    protected function setUp(): void
    {
        parent::setUp();
        $this->conditionLogger = $this->createMock(UnrecognizedConditionLogger::class);
        $this->factory = new WeatherConditionFactory($this->conditionLogger);
    }

    /**
     * @dataProvider buildDataProvider
     * @param OpenWeatherJsonCondition[] $input
     * @param WeatherCondition[] $expected
     * @param OpenWeatherJsonCondition[] $logged
     */
    public function testBuild(array $input, array $expected, array $logged): void
    {
        $this->conditionLogger
            ->expects($this->exactly(count($logged)))
            ->method('logUnrecognizedCondition')
            ->with(...$logged);

        $result = $this->factory->build($input);
        self::assertSame($expected, $result);
    }

    /**
     * @return iterable<array{
     *     input: OpenWeatherJsonCondition[],
     *     expected: WeatherCondition[],
     *     logged: OpenWeatherJsonCondition[],
     * }>
     */
    public function buildDataProvider(): iterable
    {
        yield [
            'input' => [
                [ 'id' => 211, 'main' => 'Thunderstorm', 'description' => 'Thunderstorm', 'icon' => '10d' ],
            ],
            'expected' => [ WeatherCondition::THUNDERSTORM ],
            'logged' => [],
        ];
        yield [
            'input' => [
                [ 'id' => 211, 'main' => 'Thunderstorm', 'description' => 'Thunderstorm', 'icon' => '10d' ],
                [ 'id' => 301, 'main' => 'Drizzle', 'description' => 'drizzle', 'icon' => '11d' ],
            ],
            'expected' => [ WeatherCondition::THUNDERSTORM, WeatherCondition::DRIZZLE ],
            'logged' => [],
        ];
        yield [
            'input' => [
                [ 'id' => 211, 'main' => 'Thunderstorm', 'description' => 'Thunderstorm', 'icon' => '10d' ],
                [ 'id' => 623, 'main' => 'Unknown', 'description' => 'unknown', 'icon' => 'xd' ],
                [ 'id' => 301, 'main' => 'Drizzle', 'description' => 'drizzle', 'icon' => '11d' ],
            ],
            'expected' => [ WeatherCondition::THUNDERSTORM, WeatherCondition::DRIZZLE ],
            'logged' => [
                [ 'id' => 623, 'main' => 'Unknown', 'description' => 'unknown', 'icon' => 'xd' ],
            ],
        ];
    }
}
