<?php

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Weight;

use Mkioschi\Enums\Locale;
use Mkioschi\Types\UnitOfMeasurement\Weight\Gram;
use Mkioschi\Types\UnitOfMeasurement\Weight\Kilogram;
use Mkioschi\Types\UnitOfMeasurement\Weight\Ounce;
use Mkioschi\Types\UnitOfMeasurement\Weight\Pound;
use PHPUnit\Framework\TestCase;

class KilogramTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_kilogram()
    {
        $this->assertEquals('2.1 kg' , Kilogram::from(2.1)->getHumansFormat());
        Kilogram::$defaultLocale = Locale::PT_BR;
        $this->assertEquals('2,1 kg' , Kilogram::from(2.1)->getHumansFormat());
        Kilogram::resetDefaults();

        $this->assertInstanceOf(Kilogram::class, Kilogram::from(16));
        $this->assertEquals(16, Kilogram::from(16)->value);
        $this->assertEquals('16', (string)Kilogram::from(16));
        $this->assertEquals('16 kg', Kilogram::from(16)->getHumansFormat());
        $this->assertEquals('16 kilograms', Kilogram::from(16)->getHumansFormat(false));
        $this->assertEquals('1.5 kilogram', Kilogram::from(1.5)->getHumansFormat(false));
        $this->assertEquals('1 kilogram', Kilogram::innFrom(1)->getHumansFormat(false));
        $this->assertEquals(null, Kilogram::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_kilogram_from_grams()
    {
        $this->assertInstanceOf(Kilogram::class, Kilogram::fromGrams(1500));
        $this->assertEquals(null, Kilogram::innFromGrams(null));
        $this->assertEquals(1.6, Kilogram::fromGrams(1600)->value);
        $this->assertEquals(1600, Kilogram::fromGrams(1600)->toGrams()->value);
    }

    public function test_should_be_able_to_create_a_valid_kilogram_from_pounds()
    {
        $this->assertInstanceOf(Kilogram::class, Kilogram::fromPounds(1));
        $this->assertEquals(null, Kilogram::innFromPounds(null));
        $this->assertEquals(453.59237, Kilogram::fromPounds(1000)->value);
        $this->assertEquals('1000 lbs', Kilogram::fromPounds(1000)->toPounds()->getHumansFormat());
    }

    public function test_should_be_able_to_create_a_valid_kilogram_from_ounces()
    {
        $this->assertInstanceOf(Kilogram::class, Kilogram::fromOunces(10));
        $this->assertEquals(null, Kilogram::innFromOunces(null));
        $this->assertEquals(283.495231, Kilogram::fromOunces(10000)->value);
        $this->assertEquals('100 oz', Kilogram::fromOunces(100)->toOunces()->getHumansFormat());
    }

    public function test_maths_operations_with_kilogram()
    {
        $this->assertEquals(11, Kilogram::from(10)->sum(Kilogram::from(1))->value);
        $this->assertEquals(8, Kilogram::from(10)->minus(Kilogram::from(2))->value);
        $this->assertEquals(30, Kilogram::from(10)->percentageRatio(Kilogram::from(3)));

        $this->assertEquals(11, Kilogram::from(10)->sum(Gram::from(1000))->value);
        $this->assertEquals(9, Kilogram::from(10)->minus(Gram::from(1000))->value);
        $this->assertEquals(10, Kilogram::from(10)->percentageRatio(Gram::from(1000)));

        $this->assertEquals(10.9071847392, Kilogram::from(10)->sum(Ounce::from(32))->value);
        $this->assertEquals(7.16504769, Kilogram::from(10)->minus(Ounce::from(100))->value);
        $this->assertEquals(5.386409389, Kilogram::from(10)->percentageRatio(Ounce::from(19)));

        $this->assertEquals(10.90718474, Kilogram::from(10)->sum(Pound::from(2))->value);
        $this->assertEquals(8.63922289, Kilogram::from(10)->minus(Pound::from(3))->value);
        $this->assertEquals(4.535923700000001, Kilogram::from(10)->percentageRatio(Pound::from(1)));

        $this->assertEquals(15, Kilogram::from(10)->sumPercentage(50)->value);
        $this->assertEquals(7, Kilogram::from(10)->minusPercentage(30)->value);
        $this->assertEquals(30, Kilogram::from(10)->multiply(3)->value);
        $this->assertEquals(5, Kilogram::from(10)->divide(2)->value);
        $this->assertEquals(2, Kilogram::from(10)->percentage(20)->value);
    }
}