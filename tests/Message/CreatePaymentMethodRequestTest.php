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
