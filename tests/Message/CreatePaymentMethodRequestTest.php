<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class CreatePaymentMethodRequestTest extends TestCase
{
    public function testGetData()
    {
        $request = $this->createPaymentMethodRequest();
        $request->initialize(
            [
                'customerId' => '4815162342',
                'token' => 'abc123',
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            ]
        );

        $expectedData = [
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
            'options' => [
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            ]
        ];
        $this->assertSame($expectedData, $request->getData());
    }

    public function testGetDataWithCardholderName()
    {
        $request = $this->createPaymentMethodRequest();
        $request->initialize(
            [
                'customerId' => '4815162342',
                'token' => 'abc123',
                'cardholderName' => 'John Yolo',
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            ]
        );

        $expectedData = [
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
            'cardholderName' => 'John Yolo',
            'options' => [
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            ]
        ];
        $this->assertSame($expectedData, $request->getData());
    }

    public function testGetDataWithAVS()
    {
        $request = $this->createPaymentMethodRequest();
        $request->initialize(
            [
                'customerId' => '4815162342',
                'token' => 'abc123',
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
            ]
        );

        $expectedData = [
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
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
        ];
        $this->assertSame($expectedData, $request->getData());
    }

    /**
     * @return CreatePaymentMethodRequest
     */
    private function createPaymentMethodRequest()
    {
        return new CreatePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
    }
}
