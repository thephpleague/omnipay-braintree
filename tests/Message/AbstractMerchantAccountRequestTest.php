<?php

namespace Omnipay\Braintree\Message;

use Braintree_MerchantAccount;
use Mockery;
use Omnipay\Tests\TestCase;

class AbstractMerchantAccountRequestTest extends TestCase
{
    /**
     * @var AbstractRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = Mockery::mock('\Omnipay\Braintree\Message\AbstractMerchantAccountRequest')->makePartial();
        $this->request->initialize();
    }

    /**
     * @dataProvider provideKeepsData
     * @param  string  $field
     * @param  string  $value
     */
    public function testKeepsData($field, $value)
    {
        $field = ucfirst($field);
        $this->assertSame($this->request, $this->request->{"set$field"}($value));
        $this->assertSame($value, $this->request->{"get$field"}());
    }

    public function provideKeepsData(){
        return array(
            array('merchantAccountId', 'blue_ladders_store'),
            array('masterMerchantAccountId', '14ladders_marketplace'),
            array('tosAccepted', true),
        );
    }

    /**
     * @dataProvider provideMakesBool
     * @param  string  $field
     */
    public function testMakesBool($field)
    {
        $field = ucfirst($field);

        $this->assertSame($this->request, $this->request->{"set$field"}(0));
        $this->assertSame(false, $this->request->{"get$field"}());

        $this->assertSame($this->request, $this->request->{"set$field"}(1));
        $this->assertSame(true, $this->request->{"get$field"}());
    }

    public function provideMakesBool(){
        return array(
          array('tosAccepted'),
        );
    }

    public function testBusinessData()
    {
        $business = array(
            'legalName' => 'Jane\'s Ladders',
            'dbaName' => 'Jane\'s Ladders',
            'taxId' => '98-7654321',
            'address1' => '111 Main St',
            'city' => 'Chicago',
            'state' => 'IL',
            'postCode' => '60622',
        );

        $this->request->setBusiness($business);
        $data = $this->request->getBusinessData();

        $this->assertSame($business['legalName'], $data['business']['legalName']);
        $this->assertSame($business['dbaName'], $data['business']['dbaName']);
        $this->assertSame($business['taxId'], $data['business']['taxId']);
        $this->assertSame($business['address1'], $data['business']['address']['streetAddress']);
        $this->assertSame($business['city'], $data['business']['address']['locality']);
        $this->assertSame($business['state'], $data['business']['address']['region']);
        $this->assertSame($business['postCode'], $data['business']['address']['postalCode']);
    }

    public function testFundingData()
    {
        $funding = array(
            'descriptor' => 'Blue Ladders',
            'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
            'email' => 'funding@blueladders.com',
            'mobilePhone' => '5555555555',
            'accountNumber' => '1123581321',
            'routingNumber' => '071101307',
        );

        $this->request->setFunding($funding);
        $data = $this->request->getFundingData();

        $this->assertSame($funding['descriptor'], $data['funding']['descriptor']);
        $this->assertSame($funding['destination'], $data['funding']['destination']);
        $this->assertSame($funding['email'], $data['funding']['email']);
        $this->assertSame($funding['mobilePhone'], $data['funding']['mobilePhone']);
        $this->assertSame($funding['accountNumber'], $data['funding']['accountNumber']);
        $this->assertSame($funding['routingNumber'], $data['funding']['routingNumber']);
    }

    public function testIndividualData()
    {
        $individual = array(
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'email' => 'jane@14ladders.com',
            'phone' => '5553334444',
            'birthday' => '1981-11-19',
            'ssn' => '078-05-1120',
            'address1' => '111 Main St',
            'city' => 'Chicago',
            'state' => 'IL',
            'postCode' => '60622',
        );

        $this->request->setIndividual($individual);
        $data = $this->request->getIndividualData();

        $this->assertSame($individual['firstName'], $data['individual']['firstName']);
        $this->assertSame($individual['lastName'], $data['individual']['lastName']);
        $this->assertSame($individual['email'], $data['individual']['email']);
        $this->assertSame($individual['phone'], $data['individual']['phone']);
        $this->assertSame($individual['birthday'], $data['individual']['dateOfBirth']);
        $this->assertSame($individual['ssn'], $data['individual']['ssn']);
        $this->assertSame($individual['address1'], $data['individual']['address']['streetAddress']);
        $this->assertSame($individual['city'], $data['individual']['address']['locality']);
        $this->assertSame($individual['state'], $data['individual']['address']['region']);
        $this->assertSame($individual['postCode'], $data['individual']['address']['postalCode']);
    }
}
