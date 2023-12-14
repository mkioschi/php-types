<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\Misc;

use Mkioschi\Types\Misc\Slug;
use Exception;
use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_slug()
    {
        $this->assertInstanceOf(Slug::class, Slug::from('some-string'));
        $this->assertEquals('some-string', Slug::from('some-string')->value);
        $this->assertEquals('some-string', Slug::fromText('Some string')->value);
        $this->assertFalse(Slug::isValid(' '));
        $this->assertTrue(Slug::isValid('a'));
        $this->assertFalse(Slug::isValid(''));
    }
}