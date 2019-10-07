<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class UpdateCustomerRequestTest extends TestCase
{
    /**
     * @var UpdateCustomerRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new UpdateCustomerRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
        $this->request->initialize(
            array(
                'customerId' => '4815162342',
                'customerData' => array(
                    'firstName' => 'Mike',
                    'lastName' => 'Jones',
                    'email' => 'mike.jones@example.com',
                ),
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('4815162342', $data['customerId']);
        $this->assertSame(
            array(
                'firstName' => 'Mike',
                'lastName' => 'Jones',
                'email' => 'mike.jones@example.com',
            ),
            $data['customerData']
        );
    }

    public function testRequestData()
    {
        $this->assertSame('4815162342', $this->request->getCustomerId());
        $this->assertSame(
            array(
                'firstName' => 'Mike',
                'lastName' => 'Jones',
                'email' => 'mike.jones@example.com',
            ),
            $this->request->getCustomerData()
        );
    }
}
