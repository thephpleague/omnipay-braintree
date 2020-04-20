<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Braintree\Result\Error;
use Braintree\Result\Successful;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
    }

    public function testSuccess()
    {
        $data = new Successful(1, 'transaction');

        $response = new Response($this->request, $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEmpty($response->getMessage());
    }

    public function testError()
    {
        $data = new Error(array('errors' => array(), 'params' => array(), 'message' => 'short message'));

        $response = new Response($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('short message', $response->getMessage());
    }

}
