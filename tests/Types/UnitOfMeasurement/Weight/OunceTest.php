<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Weight;

use Mkioschi\Types\UnitOfMeasurement\Weight\Ounce;
use PHPUnit\Framework\TestCase;

class OunceTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_ounce()
    {
        $this->assertInstanceOf(Ounce::class, Ounce::from(1200));
        $this->assertEquals(1200, Ounce::from(1200)->value);
        $this->assertEquals('1200', (string)Ounce::from(1200));
        $this->assertEquals('1200 oz', Ounce::from(1200)->getHumansFormat());
        $this->assertEquals('1200 ounces', Ounce::from(1200)->getHumansFormat(false));
        $this->assertEquals('1.5 ounce', Ounce::from(1.5)->getHumansFormat(false));
        $this->assertEquals('1 ounce', Ounce::innFrom(1)->getHumansFormat(false));
        $this->assertEquals(null, Ounce::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_ounce_from_kilograms()
    {
        $this->assertInstanceOf(Ounce::class, Ounce::fromKilograms(1));
        $this->assertEquals(null, Ounce::innFromKilograms(null));
        $this->assertEquals(352.739619496, Ounce::fromKilograms(10)->value);
        $this->assertEquals('6 kg', Ounce::fromKilograms(6)->toKilograms()->getHumansFormat());
    }

    public function test_should_be_able_to_create_a_valid_ounce_from_grams()
    {
        $this->assertInstanceOf(Ounce::class, Ounce::fromGrams(1));
        $this->assertEquals(null, Ounce::innFromGrams(null));
        $this->assertEquals(352.739619, Ounce::fromGrams(10000)->value);
        $this->assertEquals('275 g', Ounce::fromGrams(275)->toGrams()->getHumansFormat());
    }

    public function test_should_be_able_to_create_a_valid_ounce_from_pounds()
    {
        $this->assertInstanceOf(Ounce::class, Ounce::fromPounds(10));
        $this->assertEquals(null, Ounce::innFromPounds(null));
        $this->assertEquals(160, Ounce::fromPounds(10)->value);
        $this->assertEquals(10, Ounce::fromPounds(10)->toPounds()->value);
    }
}