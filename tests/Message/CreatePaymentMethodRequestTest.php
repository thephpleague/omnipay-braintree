<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

/**
 * Class CreatePaymentMethodRequestTest
 * @package Omnipay\Braintree\Message
 */
class CreatePaymentMethodRequestTest extends TestCase
{
    public function testGetData()
    {
        $request = $this->createPaymentMethodRequest();
        $request->initialize(
            [
                'customerId' => '4815162342',
                'token' => 'abc123',
                'cardholderName' => 'John Yolo',
                'streetAddress' => '1 Main St',
                'locality' => 'New York City',
                'postalCode' => '10044',
                'region' => 'NY',
                'countryCodeAlpha2' => 'US',
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            ]
        );

        $expectedData = [
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
            'cardholderName' => 'John Yolo',
            'billingAddress' => [
                'streetAddress' => '1 Main St',
                'locality' => 'New York City',
                'postalCode' => '10044',
                'region' => 'NY',
                'countryCodeAlpha2' => 'US',
            ],
            'options' => [
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            ]
        ];

        self::assertSame($expectedData, $request->getData());
    }

    /**
     * @return CreatePaymentMethodRequest
     */
    private function createPaymentMethodRequest()
    {
        return new CreatePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
    }
}
