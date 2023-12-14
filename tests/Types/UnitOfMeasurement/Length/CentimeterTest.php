<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Length;

use Mkioschi\Types\UnitOfMeasurement\Length\Centimeter;
use PHPUnit\Framework\TestCase;

class CentimeterTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_centimeter()
    {
        $this->assertInstanceOf(Centimeter::class, Centimeter::from(105));
        $this->assertEquals(105, Centimeter::from(105)->value);
        $this->assertEquals('105', (string)Centimeter::from(105));
        $this->assertEquals('105 cm', Centimeter::from(105)->getHumansFormat());
        $this->assertEquals('105 centimeters', Centimeter::from(105)->getHumansFormat(false));
        $this->assertEquals('1 centimeter', Centimeter::from(1)->getHumansFormat(false));
        $this->assertEquals('1 centimeter', Centimeter::innFrom(1)->getHumansFormat(false));
        $this->assertEquals(null, Centimeter::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_millimeters()
    {
        $this->assertInstanceOf(Centimeter::class, Centimeter::fromMillimeters(100));
        $this->assertEquals(10, Centimeter::fromMillimeters(100)->value);
        $this->assertEquals(100, Centimeter::fromMillimeters(100)->toMillimeters());
        $this->assertEquals(null, Centimeter::innFromMillimeters(null));
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_meters()
    {
        $this->assertInstanceOf(Centimeter::class, Centimeter::fromMeters(100));
        $this->assertEquals(10000, Centimeter::fromMeters(100)->value);
        $this->assertEquals(100, Centimeter::fromMeters(100)->toMeters());
        $this->assertEquals(null, Centimeter::innFromMeters(null));
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_inches()
    {
        $centimeter = Centimeter::fromInches(50);
        $this->assertInstanceOf(Centimeter::class, $centimeter);
        $this->assertEquals(127, $centimeter->value);
        $this->assertEquals(50, $centimeter->toInches());
        $this->assertEquals(null, Centimeter::innFromInches(null));
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_feet()
    {
        $this->assertInstanceOf(Centimeter::class, Centimeter::fromFeet(2));
        $this->assertEquals(60.96, Centimeter::fromFeet(2)->value);
        $this->assertEquals(2, Centimeter::fromFeet(2)->toFeet());
        $this->assertEquals(null, Centimeter::innFromFeet(null));
    }
}