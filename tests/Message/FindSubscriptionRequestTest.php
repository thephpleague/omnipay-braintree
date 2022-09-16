<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class FindSubscriptionRequestTest extends TestCase
{
    /**
     * @var FindSubscriptionRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $gateway = $this->buildMockGateway();
        $this->request = new FindSubscriptionRequest($this->getHttpClient(), $this->getHttpRequest(), $gateway);
        $this->request->initialize(['id' => 1]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals(1, $data);
    }

    public function testSendData()
    {
        $data = 1;
        $response = $this->request->sendData($data);

        $this->assertInstanceOf('Omnipay\Braintree\Message\SubscriptionResponse', $response);
    }

    protected function buildMockGateway()
    {
        $gateway = $this->getMockBuilder('\Braintree\Gateway')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'subscription'
            ))
            ->getMock();

        $subscription = $this->getMockBuilder('\Braintree\SubscriptionGateway')
            ->disableOriginalConstructor()
            ->getMock();

        $gateway->expects($this->any())
            ->method('subscription')
            ->will($this->returnValue($subscription));

        return $gateway;
    }
}
