<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\BoolType;
use PHPUnit\Framework\TestCase;

class BoolTypeTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_boolean()
    {
        $this->assertInstanceOf(BoolType::class, BoolType::from(true));
        $this->assertEquals('true', (string)BoolType::from(true));
        $this->assertFalse(BoolType::tryFrom(false)->value);
        $this->assertTrue(BoolType::innFrom(true)->value);
        $this->assertEquals(null, BoolType::tryFrom('true'));
        $this->assertEquals(null, BoolType::innFrom(null));
        $this->assertTrue(BoolType::from(true)->isTrue());
        $this->assertFalse(BoolType::from(false)->isTrue());
        $this->assertTrue(BoolType::from(false)->isFalse());
        $this->assertFalse(BoolType::from(true)->isFalse());
        $this->assertTrue(BoolType::fromTrue()->value);
        $this->assertFalse(BoolType::fromFalse()->value);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_truthy_string()
    {
        $this->assertEquals(null, BoolType::innFromString(null));
        $this->assertTrue(BoolType::innFromString('true')->value);
        $this->assertTrue(BoolType::fromString('true')->value);
        $this->assertTrue(BoolType::fromString('yes')->value);
        $this->assertTrue(BoolType::fromString('on')->value);
        $this->assertTrue(BoolType::fromString('1')->value);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_falsy_string()
    {
        $this->assertEquals(null, BoolType::innFromString(null));
        $this->assertFalse(BoolType::innFromString('false')->value);
        $this->assertFalse(BoolType::fromString('false')->value);
        $this->assertFalse(BoolType::fromString('no')->value);
        $this->assertFalse(BoolType::fromString('off')->value);
        $this->assertFalse(BoolType::fromString('0')->value);
    }
}
