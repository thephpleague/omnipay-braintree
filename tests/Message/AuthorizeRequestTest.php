<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            [
                'amount' => '10.00',
                'token' => 'abc123',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => [
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ]
            ]
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
        $this->assertSame('production', Configuration::environment());
    }

    public function testPaymentMethodToken()
    {
        $this->request->initialize(
            [
                'amount' => '10.00',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => [
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ],
                'paymentMethodToken' => 'fake-token-123'
            ]
        );

        $data = $this->request->getData();
        $this->assertSame('fake-token-123', $data['paymentMethodToken']);
        $this->assertArrayNotHasKey('paymentMethodNonce', $data);
    }

    public function testPaymentMethodNonce()
    {
        $this->request->initialize(
            [
                'amount' => '10.00',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => [
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ],
                'paymentMethodNonce' => 'abc123'
            ]
        );

        $data = $this->request->getData();
        $this->assertSame('abc123', $data['paymentMethodNonce']);
        $this->assertArrayNotHasKey('paymentMethodToken', $data);
    }

    public function testCustomerId()
    {
        $this->request->initialize(
            [
                'amount' => '10.00',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => [
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ],
                'customerId' => 'abc123'
            ]
        );

        $data = $this->request->getData();
        $this->assertSame('abc123', $data['customerId']);
        $this->assertArrayNotHasKey('paymentMethodToken', $data);
        $this->assertArrayNotHasKey('paymentMethodNonce', $data);
    }

    public function testSubMerchantSale()
    {
        $this->request->initialize(
            [
                'amount' => '100.00',
                'holdInEscrow' => true,
                'merchantAccountId' => 'blue_ladders_store',
                'paymentMethodToken' => 'fake-token-123',
                'serviceFeeAmount' => '10.00',
            ]
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
        $this->assertSame('sandbox', Configuration::environment());
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
        $this->markTestSkipped('Omnipay does not round the amount.');
        
        $this->assertSame($this->request, $this->request->setServiceFeeAmount('136.5'));
        $this->assertSame($this->request, $this->request->setCurrency('JPY'));
        $this->assertSame('137', $this->request->getServiceFeeAmount());
    }

    public function testServiceFeeAmountWithIntThrowsException()
    {
        $this->expectException(InvalidRequestException::class);
        // ambiguous value, avoid errors upgrading from v0.9
        $this->assertSame($this->request, $this->request->setServiceFeeAmount(10));
        $this->request->getServiceFeeAmount();
    }

    public function testServiceFeeAmountWithIntStringThrowsException()
    {
        $this->expectException(InvalidRequestException::class);
        // ambiguous value, avoid errors upgrading from v0.9
        $this->assertSame($this->request, $this->request->setServiceFeeAmount('10'));
        $this->request->getServiceFeeAmount();
    }

    public function testPaymentWithItems()
    {
        $this->request->initialize(
            [
                'amount' => '10.00',
                'token' => 'abc123',
                'transactionId' => '684',
                'testMode' => false,
                'taxExempt' => false,
                'card' => [
                    'firstName' => 'Kayla',
                    'shippingCompany' => 'League',
                ],
                'items' => [
                    [
                        'kind' => 'debit',
                        'name' => 'Item Name',
                        'quantity' => '2',
                        'totalAmount' => '19.98',
                        'unitAmount' => '9.99',
                    ]
                ]
            ]
        );

        $data = $this->request->getData();
        $this->assertTrue(is_array($data['lineItems']));
        $this->assertCount(1, $data['lineItems']);

        foreach ($data['lineItems'] as $lineItem) {
            $this->assertTrue(is_array($lineItem));
            $this->assertEquals('debit', $lineItem['kind']);
            $this->assertEquals('Item Name', $lineItem['name']);
            $this->assertEquals('2', $lineItem['quantity']);
            $this->assertEquals('19.98', $lineItem['totalAmount']);
            $this->assertEquals('9.99', $lineItem['unitAmount']);
        }
    }
}
