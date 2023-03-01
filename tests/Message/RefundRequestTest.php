<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;
use Braintree\Configuration;

class RefundRequestTest extends TestCase
{
    /**
     * @var RefundRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'transactionReference' => 'abc123',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('abc123', $data['transactionReference']);
        $this->assertSame('10.00', $data['amount']);
    }

}
