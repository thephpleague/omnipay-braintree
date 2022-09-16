<?php
/**
 * Created by PhpStorm.
 * User: xobb
 * Date: 1/22/16
 * Time: 5:53 PM
 */

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class DiscountRequestTest extends TestCase
{
    /** @var DiscountRequest */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $gateway = $this->buildMockGateway();
        $this->request = new DiscountRequest($this->getHttpClient(), $this->getHttpRequest(), $gateway);
        $this->request->initialize([]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertNull($data);
    }

    public function testSendData()
    {
        $data = [];
        $response = $this->request->sendData($data);

        $this->assertInstanceOf('Omnipay\BrainTree\Message\DiscountResponse', $response);
    }

    protected function buildMockGateway()
    {
        $gateway = $this->getMockBuilder('\Braintree\Gateway')
            ->disableOriginalConstructor()
            ->setMethods([
                'discount'
            ])
            ->getMock();

        $discount = $this->getMockBuilder('\Braintree\DiscountGateway')
            ->disableOriginalConstructor()
            ->getMock();

        $gateway->expects($this->any())
            ->method('discount')
            ->will($this->returnValue($discount));

        return $gateway;
    }
}