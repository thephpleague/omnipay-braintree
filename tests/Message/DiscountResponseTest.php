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

class DiscountResponseTest extends TestCase
{
    /** @var  DiscountRequest */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new DiscountRequest(
            $this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway()
        );
    }

    public function testGetDiscountsData()
    {
        $data = null;

        $response = new DiscountResponse($this->request, $data);
        $this->assertTrue(is_array($response->getDiscountsData()));
        $this->assertTrue(count($response->getDiscountsData()) === 0);

        $data = "discountData";

        $response = new DiscountResponse($this->request, $data);
        $this->assertEquals('discountData', $response->getDiscountsData());
    }
}