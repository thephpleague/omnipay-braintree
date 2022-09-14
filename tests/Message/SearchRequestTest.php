<?php
/**
 * Created by PhpStorm.
 * User: xobb
 * Date: 1/22/16
 * Time: 5:53 PM
 */

namespace Omnipay\Braintree\Message;

use Braintree\TransactionSearch;
use Omnipay\Tests\TestCase;

class SearchRequestTest extends TestCase
{
    /** @var SearchRequest */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $gateway = $this->buildMockGateway();
        $this->request = new SearchRequest($this->getHttpClient(), $this->getHttpRequest(), $gateway);
        $this->request->initialize([
            'searchQuery' => [
                TransactionSearch::customerId()->is(12345)
            ]
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals(
            [
                TransactionSearch::customerId()->is(12345)
            ],
            $data
        );
    }

    public function testSendData()
    {
        $response = $this->request->sendData($this->request->getData());

        $this->assertInstanceOf('Omnipay\BrainTree\Message\TransactionsResponse', $response);
    }

    protected function buildMockGateway()
    {
        $gateway = $this->getMockBuilder('\Braintree\Gateway')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'transaction'
            ))
            ->getMock();

        $discount = $this->getMockBuilder('\Braintree\TransactionGateway')
            ->disableOriginalConstructor()
            ->getMock();

        $gateway->expects($this->any())
            ->method('transaction')
            ->will($this->returnValue($discount));

        return $gateway;
    }
}