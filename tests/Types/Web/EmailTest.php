<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\Web;

use Mkioschi\Types\Web\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_email()
    {
        $this->assertInstanceOf(Email::class, Email::from('email@domain.com'));
        $this->assertEquals('email@domain.com', Email::from('email@domain.com')->value);
        $this->assertEquals('email@domain.com', (string)Email::from('EMAIL@DOMAIN.COM'));
        $this->assertEquals('email@domain.com', (string)Email::innFrom('email@domain.com'));
        $this->assertTrue(Email::from('email@domain.com')->equals(Email::from('EMAIL@DOMAIN.COM')));
        $this->assertEquals(null, Email::tryFrom('lorem_ipsum'));
        $this->assertEquals(null, Email::innFrom(null));
    }

    public function test_email_hidden_format()
    {
        $this->assertEquals('e***l@d********m', Email::from('email@domain.com')->getHiddenFormat());
        $this->assertEquals('m*@d********m', Email::from('me@domain.com')->getHiddenFormat());
        $this->assertEquals('m*@my*********m', Email::from('me@mydomain.com')->getHiddenFormat());
        $this->assertEquals('m****e@my*********m', Email::from('myname@mydomain.com')->getHiddenFormat());
        $this->assertEquals('m####e@my#########m', Email::from('myname@mydomain.com')->getHiddenFormat('#'));
    }
}