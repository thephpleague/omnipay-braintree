<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class CreatePaymentMethodRequestTest extends TestCase
{
    /**
     * @var CreatePaymentMethodRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new CreatePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
        $this->request->initialize(
            array(
                'customerId' => '4815162342',
                'token' => 'abc123',
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );
    }

    public function testGetData()
    {
        $expectedData = array(
            'customerId' => '4815162342',
            'paymentMethodNonce' => 'abc123',
            'options' => array(
                'verifyCard' => true,
                'verificationMerchantAccountId' => '123581321',
            )
        );
        $this->assertSame($expectedData, $this->request->getData());
    }
}
