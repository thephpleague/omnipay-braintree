<?php
/**
 * Created by PhpStorm.
 * User: xobb
 * Date: 1/22/16
 * Time: 5:53 PM
 */

namespace Omnipay\Braintree\Message;

use Braintree\Gateway;
use Braintree\PlanGateway;
use Omnipay\Tests\TestCase;

class PlanRequestTest extends TestCase
{
    /** @var PlanRequest */
    private $request;

    public function setUp(): void
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

        $this->assertInstanceOf(PlanResponse::class, $response);
    }

    protected function buildMockGateway()
    {
        $gateway = $this->getMockBuilder(Gateway::class)
            ->disableOriginalConstructor()
            ->setMethods(array(
                'plan'
            ))
            ->getMock();

        $plan = $this->getMockBuilder(PlanGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $gateway->expects($this->any())
            ->method('plan')
            ->will($this->returnValue($plan));

        return $gateway;
    }
}