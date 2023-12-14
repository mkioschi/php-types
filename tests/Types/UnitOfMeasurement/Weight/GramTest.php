<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Weight;

use Mkioschi\Types\UnitOfMeasurement\Weight\Gram;
use PHPUnit\Framework\TestCase;

class GramTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_gram()
    {
        $this->assertInstanceOf(Gram::class, Gram::from(200));
        $this->assertEquals(200, Gram::from(200)->value);
        $this->assertEquals('200', (string)Gram::from(200));
        $this->assertEquals('200 g', Gram::from(200)->getHumansFormat());
        $this->assertEquals('200 grams', Gram::from(200)->getHumansFormat(false));
        $this->assertEquals('1.5 gram', Gram::from(1.5)->getHumansFormat(false));
        $this->assertEquals('1 gram', Gram::innFrom(1)->getHumansFormat(false));
        $this->assertEquals(null, Gram::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_gram_from_kilograms()
    {
        $this->assertInstanceOf(Gram::class, Gram::fromKilograms(1));
        $this->assertEquals(null, Gram::innFromKilograms(null));
        $this->assertEquals(1000, Gram::fromKilograms(1)->value);
        $this->assertEquals(1, Gram::fromKilograms(1)->toKilograms()->value);
    }

    public function test_should_be_able_to_create_a_valid_gram_from_pounds()
    {
        $this->assertInstanceOf(Gram::class, Gram::fromPounds(1));
        $this->assertEquals(null, Gram::innFromPounds(null));
        $this->assertEquals(453.59237, Gram::fromPounds(1)->value);
        $this->assertEquals(1, Gram::fromPounds(1)->toPounds()->value);
    }

    public function test_should_be_able_to_create_a_valid_gram_from_ounces()
    {
        $this->assertInstanceOf(Gram::class, Gram::fromOunces(10));
        $this->assertEquals(null, Gram::innFromOunces(null));
        $this->assertEquals(283.49523125, Gram::fromOunces(10)->value);
        $this->assertEquals('10 oz', Gram::fromOunces(10)->toOunces()->getHumansFormat());
    }
}