<?php

namespace App\Tests\Factory;

use App\Factory\LengthFactory;
use App\Model\Length;
use PHPUnit\Framework\TestCase;

class LengthFactoryTest extends TestCase
{
    private LengthFactory $lengthFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lengthFactory = new LengthFactory();
    }

    /** @dataProvider buildDataProvider */
    public function testBuild(float|int $input, Length $expected): void
    {
        $length = $this->lengthFactory->build($input);
        self::assertEquals($expected, $length);
    }

    /** @dataProvider buildNullableDataProvider */
    public function testBuildNullable(float|int|null $input, ?Length $expected): void
    {
        $length = $this->lengthFactory->buildNullable($input);
        self::assertEquals($expected, $length);
    }

    /** @return iterable<array{input: int|float, expected: Length}> */
    public function buildDataProvider(): iterable
    {
        yield [
            'input' => 15.0,
            'expected' => new Length(15.0),
        ];
        yield [
            'input' => 30,
            'expected' => new Length(30.0),
        ];
    }

    /** @return iterable<array{input: int|float|null, expected: Length|null}> */
    public function buildNullableDataProvider(): iterable
    {
        yield from $this->buildDataProvider();

        yield [
            'input' => null,
            'expected' => null,
        ];
    }
}
