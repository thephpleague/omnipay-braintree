<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class UpdatePaymentMethodRequestTest extends TestCase
{
    /**
     * @var UpdatePaymentMethodRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new UpdatePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
    }

    public function testGetData()
    {
        $this->request->initialize(
            [
                'paymentMethodToken' => 'abcd1234',
                'options' => [
                    'makeDefault' => true,
                ]
            ]
        );
        $expected = [
            'token' => 'abcd1234',
            'options' => [
                'makeDefault' => true,
            ],
        ];
        $this->assertSame($expected, $this->request->getData());
    }

    public function testGetDataNoParameters()
    {
        $this->request->initialize(
            [
                'paymentMethodToken' => 'abcd1234',
            ]
        );
        $expected = [
            'token' => 'abcd1234',
        ];
        $this->assertSame($expected, $this->request->getData());
    }
}
