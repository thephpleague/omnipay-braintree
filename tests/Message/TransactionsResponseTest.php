<?php
/**
 * Created by PhpStorm.
 * User: xobb
 * Date: 1/22/16
 * Time: 5:53 PM
 */

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class TransactionsResponseTest extends TestCase
{
    /** @var  SearchRequest */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new SearchRequest(
            $this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway()
        );
    }

    public function testGetDiscountsData()
    {
        $data = null;

        $response = new TransactionsResponse($this->request, $data);
        $this->assertTrue(is_array($response->getTransactionsData()));
        $this->assertTrue(count($response->getTransactionsData()) === 0);

        $data = "transactionData";

        $response = new TransactionsResponse($this->request, $data);
        $this->assertEquals('transactionData', $response->getTransactionsData());
    }
}