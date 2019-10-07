<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;
use Braintree_Result_Successful;
use Braintree_Result_Error;

class ResponseTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

    public function testSuccess()
    {
        $data = new Braintree_Result_Successful(1, 'transaction');

        $response = new Response($this->request, $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEmpty($response->getMessage());
    }

    public function testError()
    {
        $data = new Braintree_Result_Error(array('errors' => array(), 'params' => array(), 'message' => 'short message'));

        $response = new Response($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('short message', $response->getMessage());
    }

}
