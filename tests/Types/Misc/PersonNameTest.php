<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\Misc;

use Mkioschi\Types\Misc\PersonName;
use Exception;
use PHPUnit\Framework\TestCase;

class PersonNameTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_person_name()
    {
        $this->assertInstanceOf(PersonName::class, PersonName::from('John', 'Doe'));
        $this->assertEquals('John', PersonName::from('John', 'Doe')->name);
        $this->assertEquals('Doe', PersonName::from('John', 'Doe')->surname);
        $this->assertEquals('John Doe', PersonName::from('John', 'Doe')->getFullName());
    }
}