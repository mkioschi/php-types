<?php

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Information;

use Mkioschi\Types\UnitOfMeasurement\Information\Megabyte;
use PHPUnit\Framework\TestCase;

class MegabyteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_megabyte()
    {
        $this->assertInstanceOf(Megabyte::class, Megabyte::from(6.5));
        $this->assertEquals(6.5, Megabyte::from(6.5)->value);
        $this->assertEquals('6.5', (string)Megabyte::from(6.5));
        $this->assertEquals('6.5 MB', Megabyte::from(6.5)->getHumansFormat(maxDecimalPlaces: 1));
        $this->assertEquals('6.5 megabytes', Megabyte::from(6.5)->getHumansFormat(abbreviated: false, maxDecimalPlaces: 1));
        $this->assertEquals('1 megabyte', Megabyte::from(1)->getHumansFormat(false));
        $this->assertEquals(null, Megabyte::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_bytes()
    {
        $this->assertEquals(6, Megabyte::fromBytes(6291456)->value);
        $this->assertEquals(6291456, Megabyte::fromBytes(6291456)->toBytes()->value);
        $this->assertEquals(null, Megabyte::innFromBytes(null));
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_kilobytes()
    {
        $this->assertEquals(6, Megabyte::fromKilobytes(6144)->value);
        $this->assertEquals(6144, Megabyte::fromKilobytes(6144)->toKilobytes()->value);
        $this->assertEquals(null, Megabyte::innFromKilobytes(null));
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_gigabytes()
    {
        $this->assertEquals(1259.52, Megabyte::fromGigabytes(1.23)->value);
        $this->assertEquals(1.23, Megabyte::fromGigabytes(1.23)->toGigabytes()->value);
        $this->assertEquals(null, Megabyte::innFromGigabytes(null));
    }
}
