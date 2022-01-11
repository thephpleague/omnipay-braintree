<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;

use Omnipay\Tests\TestCase;

class SearchRequestTest extends TestCase
{
    /**
     * @var SearchRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new SearchRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            array(
                'purchaseOrderNumber' => '2187588535',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('2187588535', $data['purchaseOrderNumber']);
    }
}
