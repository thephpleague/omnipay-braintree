<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;
use Braintree\Configuration;

class DeletePaymentMethodRequestTest extends TestCase
{
    /**
     * @var DeletePaymentMethodRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new DeletePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            array(
                'token' => 'abcd1234',
            )
        );
    }

    public function testGetData()
    {
        $this->assertSame('abcd1234', $this->request->getData());
    }
}
