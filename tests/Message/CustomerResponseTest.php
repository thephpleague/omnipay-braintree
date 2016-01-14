<?php
/**
 * This file is part of Rocketgraph service
 * <http://www.rocketgraph.com>
 */

namespace Omnipay\Braintree\Message;
use Omnipay\Tests\TestCase;

class CustomerResponseTest extends TestCase
{
    /**
     * @var CreateCustomerRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

    public function testGetSubscriptionData()
    {
        $data = new \stdClass();

        $response = new CustomerResponse($this->request, $data);
        $this->assertNull($response->getCustomerData());

        $data->customer = 'customerData';

        $response = new CustomerResponse($this->request, $data);
        $this->assertEquals('customerData', $response->getCustomerData());
    }

}