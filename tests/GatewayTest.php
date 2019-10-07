<?php

namespace Omnipay\Braintree;

use Omnipay\Tests\GatewayTestCase;

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

    public function testFindCustomer()
    {
        $request = $this->gateway->findCustomer(1);
        $this->assertInstanceOf('\Omnipay\Braintree\Message\FindCustomerRequest', $request);
        $this->assertEquals(1, $request->getCustomerId());
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

    public function testCreateCustomer()
    {
        $request = $this->gateway->createCustomer();
        $this->assertInstanceOf('Omnipay\Braintree\Message\CreateCustomerRequest', $request);
    }

    public function testDeleteCustomer()
    {
        $request = $this->gateway->deleteCustomer();
        $this->assertInstanceOf('Omnipay\Braintree\Message\DeleteCustomerRequest', $request);
    }

    public function testUpdateCustomer()
    {
        $request = $this->gateway->updateCustomer();
        $this->assertInstanceOf('Omnipay\Braintree\Message\UpdateCustomerRequest', $request);
    }

    public function testCreateMerchantAccount()
    {
        $request = $this->gateway->createMerchantAccount();
        $this->assertInstanceOf('Omnipay\Braintree\Message\CreateMerchantAccountRequest', $request);
    }
    
    public function testUpdateMerchantAccount()
    {
        $request = $this->gateway->updateMerchantAccount();
        $this->assertInstanceOf('Omnipay\Braintree\Message\UpdateMerchantAccountRequest', $request);
    }

    public function testCreatePaymentMethod()
    {
        $request = $this->gateway->createPaymentMethod();
        $this->assertInstanceOf('Omnipay\Braintree\Message\CreatePaymentMethodRequest', $request);
    }

    public function testDeletePaymentMethod()
    {
        $request = $this->gateway->deletePaymentMethod();
        $this->assertInstanceOf('Omnipay\Braintree\Message\DeletePaymentMethodRequest', $request);
    }

    public function testUpdatePaymentMethod()
    {
        $request = $this->gateway->updatePaymentMethod();
        $this->assertInstanceOf('Omnipay\Braintree\Message\UpdatePaymentMethodRequest', $request);
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

    public function testReleaseFromEscrow()
    {
        $request = $this->gateway->releaseFromEscrow(array('transactionId' => 'abc123'));
        $this->assertInstanceOf('Omnipay\Braintree\Message\ReleaseFromEscrowRequest', $request);
        $this->assertSame('abc123', $request->getTransactionId());
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

    public function testCreateSubscription()
    {
        $request = $this->gateway->createSubscription(array());
        $this->assertInstanceOf('Omnipay\Braintree\Message\CreateSubscriptionRequest', $request);
    }

    public function testCancelSubscription()
    {
        $request = $this->gateway->cancelSubscription('1');
        $this->assertInstanceOf('Omnipay\Braintree\Message\CancelSubscriptionRequest', $request);
    }

    public function testParseNotification()
    {
        if(\Braintree_Version::MAJOR >= 3) {
            $xml = '<notification></notification>';
            $payload = base64_encode($xml);
            $signature = \Braintree_Digest::hexDigestSha1(\Braintree_Configuration::privateKey(), $payload);
            $gatewayMock = $this->buildGatewayMock($payload);
            $gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest(), $gatewayMock);
            $params = array(
                'bt_signature' => $payload.'|'.$signature,
                'bt_payload' => $payload
            );
            $request = $gateway->parseNotification($params);
            $this->assertInstanceOf('\Braintree_WebhookNotification', $request);
        } else {
            $xml = '<notification><subject></subject></notification>';
            $payload = base64_encode($xml);
            $signature = \Braintree_Digest::hexDigestSha1(\Braintree_Configuration::privateKey(), $payload);
            $gatewayMock = $this->buildGatewayMock($payload);
            $gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest(), $gatewayMock);
            $params = array(
                'bt_signature' => $payload.'|'.$signature,
                'bt_payload' => $payload
            );
            $request = $gateway->parseNotification($params);
            $this->assertInstanceOf('\Braintree_WebhookNotification', $request);
        }
    }

    /**
     * @param $payload
     *
     * @return \Braintree_Gateway
     */
    protected function buildGatewayMock($payload)
    {
        $configuration = $this->getMockBuilder('\Braintree_Configuration')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'assertHasAccessTokenOrKeys'
            ))
            ->getMock();
        $configuration->expects($this->any())
            ->method('assertHasAccessTokenOrKeys')
            ->will($this->returnValue(null));



        $configuration->setPublicKey($payload);

        \Braintree_Configuration::$global = $configuration;
        return \Braintree_Configuration::gateway();
    }
}
