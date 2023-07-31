<?php
namespace Omnipay\Braintree\Message;

use Braintree\CustomerGateway;
use Braintree\Gateway;
use Omnipay\Tests\TestCase;

class FindCustomerRequestTest extends TestCase
{
    /**
     * @var CreateCustomerRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $gateway = $this->buildMockGateway();
        $this->request = new FindCustomerRequest($this->getHttpClient(), $this->getHttpRequest(), $gateway);
        $this->request->initialize(['customerId' => 1]);
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

        $this->assertInstanceOf('Omnipay\Braintree\Message\CustomerResponse', $response);
    }

    protected function buildMockGateway()
    {
        $gateway = $this->getMockBuilder(Gateway::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'customer'
            ])
            ->getMock();

        $customer = $this->getMockBuilder(CustomerGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $gateway->expects($this->any())
            ->method('customer')
            ->will($this->returnValue($customer));

        return $gateway;
    }
}