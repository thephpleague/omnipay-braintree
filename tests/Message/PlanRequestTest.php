<?php
/**
 * Created by PhpStorm.
 * User: xobb
 * Date: 1/22/16
 * Time: 5:53 PM
 */

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class PlanRequestTest extends TestCase
{
    /** @var PlanRequest */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $gateway = $this->buildMockGateway();
        $this->request = new PlanRequest($this->getHttpClient(), $this->getHttpRequest(), $gateway);
        $this->request->initialize(array());
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertNull($data);
    }

    public function testSendData()
    {
        $data = array();
        $response = $this->request->sendData($data);

        $this->assertInstanceOf('Omnipay\BrainTree\Message\PlanResponse', $response);
    }

    protected function buildMockGateway()
    {
        $gateway = $this->getMockBuilder('\Braintree_Gateway')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'plan'
            ))
            ->getMock();

        $plan = $this->getMockBuilder('\Braintree_PlanGateway')
            ->disableOriginalConstructor()
            ->getMock();

        $gateway->expects($this->any())
            ->method('plan')
            ->will($this->returnValue($plan));

        return $gateway;
    }
}