<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'token' => 'abc123',
                'transactionId' => '684',
                'testMode' => false,
                'card' => [
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ]
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('abc123', $data['paymentMethodNonce']);
        $this->assertSame('10.00', $data['amount']);
        $this->assertSame('684', $data['orderId']);
        $this->assertSame('Kayla', $data['billing']['firstName']);
        $this->assertSame('League', $data['shipping']['company']);
        $this->assertFalse($data['options']['submitForSettlement']);

        // Check empty values are not sent
        $this->assertFalse(isset($data['billingAddressId']));

        $this->request->configure();
        $this->assertSame('production', \Braintree_Configuration::environment());
    }

    public function testSandboxEnvironment()
    {
        $this->request->setTestMode(true);

        $this->request->configure();
        $this->assertSame('sandbox', \Braintree_Configuration::environment());
    }
}
