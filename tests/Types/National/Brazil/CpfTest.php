<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\National\Brazil;

use Mkioschi\Types\InvalidTypeException;
use Mkioschi\Types\National\Brazil\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_cpf()
    {
        $cpf = Cpf::from('732.376.660-50');
        $this->assertInstanceOf(Cpf::class, $cpf);
        $this->assertEquals('73237666050', $cpf->value);
        $this->assertEquals('73237666050', (string)$cpf);

        $cpf = Cpf::from('36749457037');
        $this->assertEquals('367.494.570-37', $cpf->getHumansFormat());
    }

    public function test_should_not_be_able_to_create_a_cpf()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('732.376.661-50');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_0()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('000.000.000-000');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_1()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('111.111.111-111');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_2()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('222.222.222-222');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_3()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('333.333.333-333');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_4()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('444.444.444-444');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_5()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('555.555.555-555');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_6()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('666.666.666-666');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_7()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('777.777.777-777');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_8()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('888.888.888-888');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_9()
    {
        $this->expectException(InvalidTypeException::class);
        Cpf::from('999.999.999-999');
    }
}