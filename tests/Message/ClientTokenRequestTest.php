<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class ClientTokenRequestTest extends TestCase
{
    /**
     * @var ClientTokenRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new ClientTokenRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

    public function testGetData()
    {
        $this->request->initialize();
        $this->assertNull($this->request->getCustomerId());
        $this->assertEmpty($this->request->getData());
    }

    public function testGetDataWithCustomer()
    {
        $data = array(
            'customerId' => '4815162342',
            'options' => array(
                'failOnDuplicatePaymentMethod' => true,
            ),
        );
        $this->request->initialize($data);
        $this->assertSame('4815162342', $this->request->getCustomerId());
        $this->assertSame($data, $this->request->getData());
    }

}
