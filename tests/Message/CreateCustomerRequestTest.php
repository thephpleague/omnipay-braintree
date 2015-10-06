<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
    /**
     * @var CreateCustomerRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
        $this->request->initialize(
            array(
                'customerData' => array(
                    'firstName' => 'Mike',
                    'lastName' => 'Jones',
                    'email' => 'mike.jones@example.com',
                )
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('Mike', $data['firstName']);
        $this->assertSame('Jones', $data['lastName']);
        $this->assertSame('mike.jones@example.com', $data['email']);
    }

    public function testRequestData()
    {
        $this->assertNull($this->request->getCustomerId());
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
