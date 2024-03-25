<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\Address;

use Mkioschi\Enums\Country;
use Mkioschi\Types\Address\PostalCode\PostalCode;
use Mkioschi\Types\InvalidTypeException;
use PHPUnit\Framework\TestCase;

class PostalCodeTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function test_should_be_able_to_create_a_valid_postal_code()
    {
        $postalCode = PostalCode::from('87209-010', Country::BRAZIL);
        $this->assertInstanceOf(PostalCode::class, $postalCode);
        $this->assertEquals('87209-010', $postalCode->value);
        $this->assertEquals('87209-010', (string)$postalCode);
        $this->assertEquals(Country::BRAZIL, $postalCode->country);
        $this->assertTrue(PostalCode::isValid('87209-010', Country::BRAZIL));
    }

    /**
     * @throws InvalidTypeException
     */
    public function test_should_not_be_able_to_create_a_postal_code_with_alpha_numeric()
    {
        $this->expectException(InvalidTypeException::class);
        PostalCode::from('ABCDE-FGH', Country::BRAZIL);
    }

    public function test_should_not_be_able_to_create_a_postal_code_with_more_chars_then_need()
    {
        $this->expectException(InvalidTypeException::class);
        PostalCode::from('872090-010', Country::BRAZIL);
    }

    public function test_should_not_be_able_to_create_a_postal_code_with_less_chars_then_need()
    {
        $this->expectException(InvalidTypeException::class);
        PostalCode::from('87209-01', Country::BRAZIL);
    }
}