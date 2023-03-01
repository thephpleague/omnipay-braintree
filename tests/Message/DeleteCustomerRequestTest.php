<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class DeleteCustomerRequestTest extends TestCase
{
    /**
     * @var DeleteCustomerRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new DeleteCustomerRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            array(
                'customerId' => '4815162342'
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('4815162342', $data);
    }

    public function testRequestData()
    {
        $this->assertSame('4815162342', $this->request->getCustomerId());
    }
}
