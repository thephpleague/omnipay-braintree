<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class UpdateSubscriptionRequestTest extends TestCase
{
    /**
     * @var UpdateCustomerRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new UpdateSubscriptionRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            [
                'id' => '4815162342',
                'subscriptionData' => [
                    'numberOfBillingCycles' => 3,
                    'paymentMethodToken' => 'fake-token-123',
                ],
            ]
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('4815162342', $data['subscriptionId']);
        $this->assertSame(
            [
                'numberOfBillingCycles' => 3,
                'paymentMethodToken' => 'fake-token-123',
            ],
            $data['subscriptionData']
        );
    }
}
