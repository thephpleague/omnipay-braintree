<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
    /**
     * @var CaptureRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
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
