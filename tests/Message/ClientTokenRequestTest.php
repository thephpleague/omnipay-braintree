<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class ClientTokenRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new ClientTokenRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
        $this->request->initialize();
    }

    public function testGetData()
    {
        $data = $this->request->getData();

    }

}
