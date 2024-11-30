<?php

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Weight;

use Mkioschi\Types\UnitOfMeasurement\Weight\Pound;
use PHPUnit\Framework\TestCase;

class PoundTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_pound()
    {
        $this->assertInstanceOf(Pound::class, Pound::from(200));
        $this->assertEquals(200, Pound::from(200)->value);
        $this->assertEquals('200', (string)Pound::from(200));
        $this->assertEquals('200 lbs', Pound::from(200)->getHumansFormat());
        $this->assertEquals('200 pounds', Pound::from(200)->getHumansFormat(false));
        $this->assertEquals('1.5 pound', Pound::from(1.5)->getHumansFormat(false));
        $this->assertEquals('1 pound', Pound::innFrom(1)->getHumansFormat(false));
        $this->assertEquals(null, Pound::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_pound_from_kilograms()
    {
        $this->assertInstanceOf(Pound::class, Pound::fromKilograms(1));
        $this->assertEquals(null, Pound::innFromKilograms(null));
        $this->assertEquals(13.2277357308, Pound::fromKilograms(6)->value);
        $this->assertEquals('12 kg', Pound::fromKilograms(12)->toKilograms()->getHumansFormat());
    }

    public function test_should_be_able_to_create_a_valid_pound_from_grams()
    {
        $this->assertInstanceOf(Pound::class, Pound::fromGrams(1));
        $this->assertEquals(null, Pound::innFromGrams(null));
        $this->assertEquals(275.577827731097, Pound::fromGrams(125000)->value);
        $this->assertEquals(275, Pound::fromGrams(275)->toGrams()->value);
    }

    public function test_should_be_able_to_create_a_valid_pound_from_ounces()
    {
        $this->assertInstanceOf(Pound::class, Pound::fromOunces(10));
        $this->assertEquals(null, Pound::innFromOunces(null));
        $this->assertEquals(31.25, Pound::fromOunces(500)->value);
        $this->assertEquals(10, Pound::fromOunces(10)->toOunces()->value);
    }
}