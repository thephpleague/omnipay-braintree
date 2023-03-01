<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class ReleaseFromEscrowRequestTest extends TestCase
{
    /**
     * @var ReleaseFromEscrowRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new ReleaseFromEscrowRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
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
