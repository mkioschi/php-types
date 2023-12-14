<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\Misc;

use Exception;
use Mkioschi\Types\Misc\Path;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_path()
    {
        $this->assertInstanceOf(Path::class, Path::from('/var/www'));
        $this->assertTrue(Path::from('./var/www/')->isRelativePath());
        $this->assertTrue(Path::from('/var/www/')->isAbsolutePath());
        $this->assertEquals('/var/www/../www/html', Path::from('/var/www/')->back()->join('www', 'html')->value);
        $this->assertEquals('/var/www/', Path::from('var/www/')->getAsAbsolutePath());
        $this->assertEquals('/var/www/', Path::from('/var/www/')->getAsAbsolutePath());
        $this->assertEquals('var/www/', Path::from('var/www/')->getAsRelativePath());
        $this->assertEquals('var/www/', Path::from('/var/www/')->getAsRelativePath());
    }
}