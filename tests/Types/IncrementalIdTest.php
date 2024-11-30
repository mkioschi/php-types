<?php

namespace Mkioschi\Tests\Types;

use Mkioschi\Types\IncrementalId;
use Exception;
use PHPUnit\Framework\TestCase;

class IncrementalIdTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_incremental_id()
    {
        $this->assertInstanceOf(IncrementalId::class, IncrementalId::from(1));
        $this->assertEquals('123', (string)IncrementalId::from(123));
        $this->assertTrue(IncrementalId::from(123)->equals(IncrementalId::from(123)));
        $this->assertEquals(123, IncrementalId::tryFrom(123)->value);
        $this->assertEquals(123, IncrementalId::innFrom(123)->value);
        $this->assertEquals(null, IncrementalId::innFrom(null));
        $this->assertTrue(IncrementalId::isValid(123));
        $this->assertFalse(IncrementalId::isValid(-123));
        $this->assertFalse(IncrementalId::isValid('123'));
        $this->assertEquals(124, IncrementalId::from(123)->next()->value);
        $this->assertEquals(122, IncrementalId::from(123)->previous()->value);
        $this->assertEquals(null, IncrementalId::from(1)->previous());
    }
}
