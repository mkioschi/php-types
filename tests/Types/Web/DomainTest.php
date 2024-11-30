<?php

namespace Mkioschi\Tests\Types\Web;

use Mkioschi\Types\Web\Domain;
use PHPUnit\Framework\TestCase;

class DomainTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_url()
    {
        $this->assertInstanceOf(Domain::class, Domain::from('github.com'));
        $this->assertEquals('github.com', Domain::from('github.com')->value);
        $this->assertEquals('github.com', Domain::innFrom('github.com')->value);
        $this->assertEquals('github.com', Domain::tryFrom('github.com')->value);
        $this->assertEquals(null, Domain::innFrom(null));
        $this->assertEquals(null, Domain::tryFrom('https://github.com'));
    }
}