<?php

namespace Mkioschi\Tests\Types\Misc;

use Mkioschi\Types\Misc\StrongPassword;
use Exception;
use PHPUnit\Framework\TestCase;

class StrongPasswordTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_strong_password()
    {
        $this->assertInstanceOf(StrongPassword::class, StrongPassword::from('P@ssw0rd'));
        $this->assertEquals('P@ssw0rd', StrongPassword::from('P@ssw0rd')->value);
        $this->assertEquals(null, StrongPassword::tryFrom('123123'));
    }
}