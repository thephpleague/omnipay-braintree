<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class ClientTokenResponseTest extends TestCase
{
    /**
     * @var ClientTokenRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new ClientTokenRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
    }

    public function testSuccess()
    {
        $data = 'some-token-value';

        $response = new ClientTokenResponse($this->request, $data);

        $this->assertEquals($data, $response->getToken());
    }
}
