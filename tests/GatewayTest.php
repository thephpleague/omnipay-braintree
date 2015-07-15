<?php

namespace Omnipay\Braintree;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    protected $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = array(
            'amount' => '10.00',
            'token' => 'abcdef',
        );
    }

    public function testAuthorize()
    {
        $request = $this->gateway->authorize(array('amount' => '10.00'));
        $this->assertInstanceOf('Omnipay\Braintree\Message\AuthorizeRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testCapture()
    {
        $request = $this->gateway->capture(array('amount' => '10.00'));
        $this->assertInstanceOf('Omnipay\Braintree\Message\CaptureRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array('amount' => '10.00'));
        $this->assertInstanceOf('Omnipay\Braintree\Message\PurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testRefund()
    {
        $request = $this->gateway->refund(array('amount' => '10.00'));
        $this->assertInstanceOf('Omnipay\Braintree\Message\RefundRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testVoid()
    {
        $request = $this->gateway->void();
        $this->assertInstanceOf('Omnipay\Braintree\Message\VoidRequest', $request);
    }

    public function testFind()
    {
        $request = $this->gateway->find(array());
        $this->assertInstanceOf('Omnipay\Braintree\Message\FindRequest', $request);
    }

    public function testClientToken()
    {
        $request = $this->gateway->clientToken(array());
        $this->assertInstanceOf('Omnipay\Braintree\Message\ClientTokenRequest', $request);
    }
}
