<?php

namespace App\Tests\Factory;

use App\Factory\LengthFactory;
use App\Factory\SpeedFactory;
use App\Factory\TemperatureFactory;
use App\Factory\WeatherConditionFactory;
use App\Factory\WeatherModelFactory;
use App\Model\Length;
use App\Model\Speed;
use App\Model\Temperature;
use App\Model\WeatherCondition;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WeatherModelFactoryTest extends TestCase
{
    private MockObject|WeatherConditionFactory $conditionFactory;
    private MockObject|LengthFactory $lengthFactory;
    private MockObject|TemperatureFactory $temperatureFactory;
    private MockObject|SpeedFactory $speedFactory;

    private WeatherModelFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->conditionFactory = $this->createMock(WeatherConditionFactory::class);
        $this->lengthFactory = $this->createMock(LengthFactory::class);
        $this->temperatureFactory = $this->createMock(TemperatureFactory::class);
        $this->speedFactory = $this->createMock(SpeedFactory::class);

        $this->factory = new WeatherModelFactory(
            $this->conditionFactory,
            $this->lengthFactory,
            $this->temperatureFactory,
            $this->speedFactory,
        );
    }

    /** @dataProvider buildFromOpenWeatherJson */
    public function testBuildFromOpenWeatherJson(array $input): void
    {
        $temperature1 = $this->createMock(Temperature::class);
        $temperature2 = $this->createMock(Temperature::class);
        $temperature3 = $this->createMock(Temperature::class);
        $length = $this->createMock(Length::class);
        $speed1 = $this->createMock(Speed::class);
        $speed2 = $this->createMock(Speed::class);
        $conditions = [ WeatherCondition::DRIZZLE ];

        $this->temperatureFactory
            ->expects($this->exactly(3))
            ->method('build')
            ->withConsecutive([$input['temp']], [$input['feels_like']], [$input['dew_point']])
            ->willReturnOnConsecutiveCalls($temperature1, $temperature2, $temperature3);
        $this->lengthFactory
            ->expects($this->once())
            ->method('buildNullable')
            ->with($input['visibility'] ?? null)
            ->willReturn($length);
        $this->speedFactory
            ->expects($this->once())
            ->method('build')
            ->with($input['wind_speed'])
            ->willReturn($speed1);
        $this->speedFactory
            ->expects($this->once())
            ->method('buildNullable')
            ->with($input['wind_gust'] ?? null)
            ->willReturn($speed2);
        $this->conditionFactory
            ->expects($this->once())
            ->method('build')
            ->with($input['weather'])
            ->willReturn($conditions);

        $weather = $this->factory->buildFromOpenWeatherJson($input);
        self::assertEquals((new \DateTimeImmutable())->setTimestamp($input['dt']), $weather->timestamp);
        self::assertSame($temperature1, $weather->temperature);
        self::assertSame($temperature2, $weather->feelsLike);
        self::assertSame((float) $input['pressure'], $weather->pressure);
        self::assertSame((float) $input['humidity'], $weather->humidity);
        self::assertSame($temperature3, $weather->dewPoint);
        self::assertSame($input['uvi'] === null ? null : (float) $input['uvi'], $weather->uvi);
        self::assertSame((float) $input['clouds'], $weather->clouds);
        self::assertSame($length, $weather->visibility);
        self::assertSame((float) $input['wind_deg'], $weather->windDegrees);
        self::assertSame($speed1, $weather->windSpeed);
        self::assertSame($speed2, $weather->windGust);

        $rain = ($input['rain'] ?? [])['1h'] ?? null;
        $snow = ($input['snow'] ?? [])['1h'] ?? null;
        self::assertSame($rain === null ? null : (float) $rain, $weather->lastHourRain);
        self::assertSame($snow === null ? null : (float) $snow, $weather->lastHourSnow);
        self::assertSame($conditions, $weather->weatherConditions);
    }

    public function buildFromOpenWeatherJson(): iterable
    {
        yield [
            'input' => [
                'dt' => 1671796260,
                'temp' => 15.0,
                'feels_like' => 30.0,
                'pressure' => 30,
                'humidity' => 50,
                'dew_point' => 45,
                'uvi' => 50,
                'clouds' => 70,
                'visibility' => 30,
                'wind_deg' => 15,
                'wind_speed' => 67,
                'wind_gust' => 31,
                'rain' => [ '1h' => 15 ],
                'weather' => [ 'id' => 301 ],
            ],
        ];
    }
}
