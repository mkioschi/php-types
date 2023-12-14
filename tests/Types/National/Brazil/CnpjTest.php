<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\National\Brazil;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\National\Brazil\Cnpj;
use PHPUnit\Framework\TestCase;

class CnpjTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_cnpj()
    {
        $cnpj = Cnpj::from('67.947.309/0001-64');
        $this->assertInstanceOf(Cnpj::class, $cnpj);
        $this->assertEquals('67947309000164', $cnpj->value);
        $this->assertEquals('67947309000164', (string)$cnpj);

        $cnpj = Cnpj::from('67947309000164');
        $this->assertEquals('67.947.309/0001-64', $cnpj->getHumansFormat());
    }

    public function test_should_not_be_able_to_create_a_cnpj()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('67.947.309/0001-60');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_0()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('00.000.000/0000-00');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_1()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('11.111.111/1111-11');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_2()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('22.222.222/2222-22');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_3()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('33.333.333/3333-33');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_4()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('44.444.444/4444-44');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_5()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('55.555.555/5555-55');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_6()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('66.666.666/6666-66');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_7()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('77.777.777/7777-77');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_8()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('88.888.888/8888-88');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_9()
    {
        $this->expectException(InvalidTypeHttpException::class);
        Cnpj::from('99.999.999/9999-99');
    }
}