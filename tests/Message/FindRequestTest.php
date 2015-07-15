<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class FindRequestTest extends TestCase
{
    /**
     * @var FindRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new FindRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
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
