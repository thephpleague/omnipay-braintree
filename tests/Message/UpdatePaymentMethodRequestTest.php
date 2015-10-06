<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class UpdatePaymentMethodRequestTest extends TestCase
{
    /**
     * @var UpdatePaymentMethodRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new UpdatePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

    public function testGetData()
    {
        $this->request->initialize(
            array(
                'token' => 'abcd1234',
                'makeDefault' => true,
            )
        );
        $expected = array(
            'token' => 'abcd1234',
            'parameters' => array(
                'options' => array(
                    'makeDefault' => true,
                ),
            ),
        );
        $this->assertSame($expected, $this->request->getData());
    }

    public function testGetDataNoParameters()
    {
        $this->request->initialize(
            array(
                'token' => 'abcd1234',
            )
        );
        $expected = array(
            'token' => 'abcd1234',
        );
        $this->assertSame($expected, $this->request->getData());
    }
}
