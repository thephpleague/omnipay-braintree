<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;
use Braintree\Configuration;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'token' => 'abc123',
                'testMode' => false,
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('abc123', $data['paymentMethodNonce']);
        $this->assertSame('10.00', $data['amount']);

        $this->assertTrue($data['options']['submitForSettlement']);
    }

}
