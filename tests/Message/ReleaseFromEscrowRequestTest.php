<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class ReleaseFromEscrowRequestTest extends TestCase
{
    /**
     * @var ReleaseFromEscrowRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new ReleaseFromEscrowRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
        $this->request->initialize(
            array(
                'transactionId' => 'abc123',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('abc123', $data['transactionId']);
    }

}
