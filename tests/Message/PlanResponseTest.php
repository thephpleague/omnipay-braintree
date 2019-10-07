<?php
/**
 * Created by PhpStorm.
 * User: xobb
 * Date: 1/22/16
 * Time: 5:53 PM
 */

namespace Omnipay\Braintree\Message;
use Omnipay\Tests\TestCase;

class PlanResponseTest extends TestCase
{
    /** @var  PlanRequest */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new PlanRequest(
            $this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway()
        );
    }

    public function testGetPlansData()
    {
        $data = null;

        $response = new PlanResponse($this->request, $data);
        $this->assertTrue(is_array($response->getPlansData()));
        $this->assertTrue(count($response->getPlansData()) === 0);

        $data = "planData";

        $response = new PlanResponse($this->request, $data);
        $this->assertEquals('planData', $response->getPlansData());
    }
}