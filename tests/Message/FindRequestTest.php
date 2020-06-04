<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class FindRequestTest extends TestCase
{
    /**
     * @var FindRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new FindRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            [
                'transactionReference' => 'abc123',
            ]
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('abc123', $data['transactionReference']);
    }

}
