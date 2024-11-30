<?php

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Information;

use Mkioschi\Types\UnitOfMeasurement\Information\Byte;
use Mkioschi\Types\UnitOfMeasurement\Information\Gigabyte;
use Mkioschi\Types\UnitOfMeasurement\Information\Kilobyte;
use Mkioschi\Types\UnitOfMeasurement\Information\Megabyte;
use PHPUnit\Framework\TestCase;

class InformationTest extends TestCase
{
    public function test_should_be_able_to_calculate_math_operations()
    {
        $this->assertEquals(
            expected: 2048,
            actual: Byte::from(1024)->sum(1024)->value
        );

        $this->assertEquals(
            expected: 2048,
            actual: Byte::from(1024)->sum(Kilobyte::from(1))->value
        );

        $this->assertEquals(
            expected: 1049600,
            actual: Byte::from(1024)->sum(Megabyte::from(1))->value
        );

        $this->assertEquals(
            expected: 1073742848,
            actual: Byte::from(1024)->sum(Gigabyte::from(1))->value
        );
    }
}