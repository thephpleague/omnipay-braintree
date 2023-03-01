<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class VoidRequestTest extends TestCase
{
    /**
     * @var VoidRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new VoidRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            array(
                'transactionReference' => 'abc123',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('abc123', $data['transactionReference']);
    }

}
