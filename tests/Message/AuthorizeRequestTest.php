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

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'token' => 'abc123',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => array(
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                )
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertArrayNotHasKey('paymentMethodToken', $data);
        $this->assertSame('abc123', $data['paymentMethodNonce']);
        $this->assertSame('10.00', $data['amount']);
        $this->assertSame('684', $data['orderId']);
        $this->assertSame('Kayla', $data['billing']['firstName']);
        $this->assertSame('League', $data['shipping']['company']);
        $this->assertFalse($data['options']['submitForSettlement']);
        $this->assertFalse($data['taxExempt']);

        // Check empty values are not sent
        $this->assertFalse(isset($data['billingAddressId']));

        $this->request->configure();
        $this->assertSame('production', \Braintree_Configuration::environment());
    }

    public function testPaymentMethodToken()
    {
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => array(
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ),
                'paymentMethodToken' => 'fake-token-123'
            )
        );

        $data = $this->request->getData();
        $this->assertSame('fake-token-123', $data['paymentMethodToken']);
        $this->assertArrayNotHasKey('paymentMethodNonce', $data);
    }

    public function testPaymentMethodNonce()
    {
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => array(
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ),
                'paymentMethodNonce' => 'abc123'
            )
        );

        $data = $this->request->getData();
        $this->assertSame('abc123', $data['paymentMethodNonce']);
        $this->assertArrayNotHasKey('paymentMethodToken', $data);
    }

    public function testCustomerId()
    {
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => array(
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ),
                'customerId' => 'abc123'
            )
        );

        $data = $this->request->getData();
        $this->assertSame('abc123', $data['customerId']);
        $this->assertArrayNotHasKey('paymentMethodToken', $data);
        $this->assertArrayNotHasKey('paymentMethodNonce', $data);
    }

    public function testSubMerchantSale()
    {
        $this->request->initialize(
            array(
                'amount' => '100.00',
                'holdInEscrow' => true,
                'merchantAccountId' => 'blue_ladders_store',
                'paymentMethodToken' => 'fake-token-123',
                'serviceFeeAmount' => '10.00',
            )
        );

        $data = $this->request->getData();
        $this->assertTrue($data['options']['holdInEscrow']);
        $this->assertSame('blue_ladders_store', $data['merchantAccountId']);
        $this->assertSame('10.00', $data['serviceFeeAmount']);
    }

    public function testSandboxEnvironment()
    {
        $this->request->setTestMode(true);

        $this->request->configure();
        $this->assertSame('sandbox', \Braintree_Configuration::environment());
    }

    public function testServiceFeeAmount()
    {
        $this->assertSame($this->request, $this->request->setServiceFeeAmount('2.00'));
        $this->assertSame('2.00', $this->request->getServiceFeeAmount());
    }

    public function testServiceFeeAmountWithFloat()
    {
        $this->assertSame($this->request, $this->request->setServiceFeeAmount(2.0));
        $this->assertSame('2.00', $this->request->getServiceFeeAmount());
    }

    public function testServiceFeeAmountWithEmpty()
    {
        $this->assertSame($this->request, $this->request->setServiceFeeAmount(null));
        $this->assertSame(null, $this->request->getServiceFeeAmount());
    }

    public function testGetServiceFeeAmountNoDecimals()
    {
        $this->assertSame($this->request, $this->request->setCurrency('JPY'));
        $this->assertSame($this->request, $this->request->setServiceFeeAmount('1366'));
        $this->assertSame('1366', $this->request->getServiceFeeAmount());
    }

    public function testGetServiceFeeAmountNoDecimalsRounding()
    {
        $this->assertSame($this->request, $this->request->setServiceFeeAmount('136.5'));
        $this->assertSame($this->request, $this->request->setCurrency('JPY'));
        $this->assertSame('137', $this->request->getServiceFeeAmount());
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testServiceFeeAmountWithIntThrowsException()
    {
        // ambiguous value, avoid errors upgrading from v0.9
        $this->assertSame($this->request, $this->request->setServiceFeeAmount(10));
        $this->request->getServiceFeeAmount();
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testServiceFeeAmountWithIntStringThrowsException()
    {
        // ambiguous value, avoid errors upgrading from v0.9
        $this->assertSame($this->request, $this->request->setServiceFeeAmount('10'));
        $this->request->getServiceFeeAmount();
    }
}
