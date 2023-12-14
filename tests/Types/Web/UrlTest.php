<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\Web;

use Mkioschi\Types\Web\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_url()
    {
        $this->assertInstanceOf(Url::class, Url::from('https://github.com'));
        $this->assertTrue(Url::from('https://github.com')->isSecure());
        $this->assertEquals('https://github.com', Url::from('https://github.com')->value);
        $this->assertEquals('https://github.com', Url::innFrom('https://github.com')->value);
        $this->assertEquals('https://github.com', Url::tryFrom('https://github.com')->value);
        $this->assertEquals(null, Url::innFrom(null));
        $this->assertEquals(null, Url::tryFrom('github.com'));
    }

    public function test_url_parts()
    {
        $url = Url::from('https://username:password@hostname:9090/path?arg=value#anchor');
        $this->assertEquals('https', $url->getScheme());
        $this->assertEquals('username', $url->getUser());
        $this->assertEquals('password', $url->getPassword());
        $this->assertEquals('hostname', $url->getHost());
        $this->assertEquals(9090, $url->getPort());
        $this->assertEquals('/path', $url->getPath());
        $this->assertEquals('arg=value', $url->getQuery());
        $this->assertEquals(['arg' => 'value'], $url->getQueryAsArray());
        $this->assertEquals('anchor', $url->getFragment());
    }
}