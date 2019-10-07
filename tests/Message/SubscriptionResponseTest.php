<?php
/**
 * This file is part of Rocketgraph service
 * <http://www.rocketgraph.com>
 */

namespace Omnipay\Braintree\Message;
use Omnipay\Tests\TestCase;

class SubscriptionResponseTest extends TestCase
{
    /**
     * @var CreateSubscriptionRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new CreateSubscriptionRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

    public function testGetSubscriptionData()
    {
        $data = new \stdClass();

        $response = new SubscriptionResponse($this->request, $data);
        $this->assertNull($response->getSubscriptionData());

        $data->subscription = 'subscriptionData';

        $response = new SubscriptionResponse($this->request, $data);
        $this->assertEquals('subscriptionData', $response->getSubscriptionData());
    }

}