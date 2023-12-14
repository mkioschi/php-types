<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\Address;

use Mkioschi\Enums\Country;
use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Address\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_address()
    {
        $address = Address::from(
            country: Country::BRAZIL,
            addressLine1: 'Estrada Mestra para Cerâmica, 328',
            addressLine2: 'Lote B',
            dependentLocality: 'Zona 3',
            locality: 'Altônia',
            adminArea: 'Paraná',
            postalCode: '87550-000',
            poBox: '12'
        );
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('Estrada Mestra para Cerâmica, 328', $address->addressLine1);
        $this->assertEquals(Country::BRAZIL, $address->country);
        $this->assertEquals('12', $address->poBox);
        $this->assertEquals('Lote B', $address->addressLine2);
        $this->assertEquals('Zona 3', $address->dependentLocality);
        $this->assertEquals('Altônia', $address->locality);
        $this->assertEquals('Paraná', $address->adminArea);
        $this->assertEquals('87550-000', $address->postalCode);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_address_from_array()
    {
        $addressArray = [
            'country' => 'BR',
            'address_line_1' => 'Estrada Mestra para Cerâmica, 328',
            'address_line_2' => 'Lote B',
            'dependent_locality' => 'Zona 3',
            'locality' => 'Altônia',
            'admin_area' => 'Paraná',
            'postal_code' => '87550-000',
            'po_box' =>  null,
        ];

        $address = Address::fromArray($addressArray);
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($addressArray, $address->toArray());
    }
}