<?php

namespace Mkioschi\Tests\Types;

use Mkioschi\Types\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_str()
    {
        $this->assertInstanceOf(Str::class, Str::from('Some string'));
        $this->assertEquals('Some string', (string)Str::from('Some string'));
        $this->assertTrue(Str::from('Some string')->equals(Str::from('Some string')));
        $this->assertFalse(Str::from('Some string')->equals(Str::from('Another string')));
        $this->assertEquals('Some string', Str::tryFrom('Some string')->value);
        $this->assertEquals('Some string', Str::innFrom('Some string')->value);
        $this->assertEquals(null, Str::innFrom(null));
        $this->assertFalse(Str::isValid(123));
        $this->assertFalse(Str::isValid(['host' => 'github.com']));
        $this->assertTrue(Str::isValid('Some string'));
        $this->assertEquals('1123', Str::extractNumbers('Some string 1: 123'));
        $this->assertEquals(11, Str::from('Some string')->length());
    }

    public function test_should_be_able_to_slugify_a_string()
    {
        $this->assertEquals('some-string', Str::slugify('Some string'));
        $this->assertEquals('some-string', Str::from('Some string')->getSlugFormat());
    }
}
