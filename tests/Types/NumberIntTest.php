<?php

namespace Mkioschi\Tests\Types;

use Mkioschi\Types\NumberInt;
use PHPUnit\Framework\TestCase;

class NumberIntTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_number_integer()
    {
        $this->assertInstanceOf(NumberInt::class, NumberInt::from(123));
        $this->assertEquals('123', (string)NumberInt::from(123));
        $this->assertTrue(NumberInt::from(123)->equals(NumberInt::from(123)));
        $this->assertFalse(NumberInt::from(123)->equals(NumberInt::from(321)));
        $this->assertEquals(123, NumberInt::tryFrom(123)->value);
        $this->assertEquals(123, NumberInt::innFrom(123)->value);
        $this->assertEquals(null, NumberInt::innFrom(null));
        $this->assertTrue(NumberInt::isValid(123));
        $this->assertFalse(NumberInt::isValid(123.45));
        $this->assertFalse(NumberInt::isValid('123'));
        $this->assertFalse(NumberInt::isValid(['host' => 'github.com']));
    }
}
