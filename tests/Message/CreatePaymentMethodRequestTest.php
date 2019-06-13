<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class CreatePaymentMethodRequestTest extends TestCase
{
    public function testGetData()
    {
        $request = $this->createPaymentMethodRequest();
        $request->initialize(
            array(
                'customerId' => '4815162342',
                'token' => 'abc123',
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );

        $expectedData = array(
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
            'billingAddress' => array(
                'streetAddress' => null,
                'locality' => null,
                'postalCode' => null,
                'region' => null,
                'countryCodeAlpha2' => null
            ),
            'options' => array(
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );
        $this->assertSame($expectedData, $request->getData());
    }

    public function testGetDataWithCardholderName()
    {
        $request = $this->createPaymentMethodRequest();
        $request->initialize(
            array(
                'customerId' => '4815162342',
                'token' => 'abc123',
                'cardholderName' => 'John Yolo',
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );

        $expectedData = array(
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
            'cardholderName' => 'John Yolo',
            'billingAddress' => array(
                'streetAddress' => null,
                'locality' => null,
                'postalCode' => null,
                'region' => null,
                'countryCodeAlpha2' => null
            ),
            'options' => array(
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );
        $this->assertSame($expectedData, $request->getData());
    }

    public function testGetDataWithAddress()
    {
        $request = $this->createPaymentMethodRequest();
        $request->initialize(
            array(
                'customerId' => '4815162342',
                'token' => 'abc123',
                'streetAddress' => '1 Main St',
                'locality' => 'New York City',
                'postalCode' => '10044',
                'region' => 'NY',
                'countryCodeAlpha2' => 'US',
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );
        $expectedData = array(
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
            'billingAddress' => array(
                'streetAddress' => '1 Main St',
                'locality' => 'New York City',
                'postalCode' => '10044',
                'region' => 'NY',
                'countryCodeAlpha2' => 'US'
            ),
            'options' => array(
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );
        $this->assertSame($expectedData, $request->getData());
    }

    /**
     * @return CreatePaymentMethodRequest
     */
    private function createPaymentMethodRequest()
    {
        return new CreatePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }
}
