<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
    /**
     * @var CreateCustomerRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            [
                'customerData' => [
                    'firstName' => 'Mike',
                    'lastName' => 'Jones',
                    'email' => 'mike.jones@example.com',
                ]
            ]
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('Mike', $data['firstName']);
        $this->assertSame('Jones', $data['lastName']);
        $this->assertSame('mike.jones@example.com', $data['email']);
    }

    public function testRequestData()
    {
        $this->assertNull($this->request->getCustomerId());
        $this->assertSame(
            [
                'firstName' => 'Mike',
                'lastName' => 'Jones',
                'email' => 'mike.jones@example.com',
            ],
            $this->request->getCustomerData()
        );
    }
    
    public function testGetDataWithAVS()
    {
        $this->request->initialize([
            'customerData' => [
                'firstName' => 'Mike',
                'lastName' => 'Jones',
                'email' => 'mike.jones@example.com',
                'paymentMethodNonce' => 'testnonce',
            ],
            'addBillingAddressToPaymentMethod' => true,
            'failOnDuplicatePaymentMethod'     => false,
            'makeDefault'                      => true,
            'verifyCard'                       => true,
            'card'               => [
                'billingFirstName' => 'John',
                'billingLastName'  => 'Doe',
                'billingAddress1'  => '123 Main Street',
                'billingAddress2'  => 'Suite 101',
                'billingCity'      => 'Los Angeles',
                'billingState'     => 'CA',
                'billingPostcode'  => '90210',
                'billingCountry'   => 'USA',
                'billingCompany'   => 'Apple Inc',
            ],
        ]);

        $expectedData = [
            'firstName' => 'Mike',
            'lastName' => 'Jones',
            'email' => 'mike.jones@example.com',
            'paymentMethodNonce' => 'testnonce',
            'creditCard' => [
                'options' => [
                    'addBillingAddressToPaymentMethod' => true,
                    'failOnDuplicatePaymentMethod'     => false,
                    'makeDefault'                      => true,
                    'verifyCard'                       => true,
                ],
                'billingAddress'               => [
                    'company' => 'Apple Inc',
                    'countryCodeAlpha3' => 'USA',
                    'extendedAddress' => 'Suite 101',
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'locality' => 'Los Angeles',
                    'postalCode' => '90210',
                    'region' => 'CA',
                    'streetAddress' => '123 Main Street',
                ],
            ],
        ];
        $this->assertSame($expectedData, $this->request->getData());
    }

}
