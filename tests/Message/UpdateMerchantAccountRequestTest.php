<?php

namespace Omnipay\Braintree\Message;

use Braintree_MerchantAccount;
use Omnipay\Tests\TestCase;

class UpdateMerchantAccountRequestTest extends TestCase
{
    /**
     * @var UpdateMerchantAccountRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new UpdateMerchantAccountRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
        $this->request->initialize(
            array(
                'individual' => array(
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
                ),
                'business' => array(
                    'legalName' => 'Jane\'s Ladders',
                    'dbaName' => 'Jane\'s Ladders',
                    'taxId' => '98-7654321',
                    'address1' => '111 Main St',
                    'city' => 'Chicago',
                    'state' => 'IL',
                    'postCode' => '60622',
                ),
                'funding' => array(
                    'descriptor' => 'Blue Ladders',
                    'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
                    'email' => 'funding@blueladders.com',
                    'mobilePhone' => '5555555555',
                    'accountNumber' => '1123581321',
                    'routingNumber' => '071101307',
                ),
                'merchantAccountId' => "blue_ladders_store",
            )
        );
    }

    public function testGetData()
    {
        $expected = array(
            'merchantData' => array(
                'business' => array(
                    'address' => array(
                        'streetAddress' => '111 Main St',
                        'locality' => 'Chicago',
                        'postalCode' => '60622',
                        'region' => 'IL',
                    ),
                    'dbaName' => 'Jane\'s Ladders',
                    'legalName' => 'Jane\'s Ladders',
                    'taxId' => '98-7654321',
                ),
                'funding' => array(
                    'accountNumber' => '1123581321',
                    'descriptor' => 'Blue Ladders',
                    'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
                    'email' => 'funding@blueladders.com',
                    'mobilePhone' => '5555555555',
                    'routingNumber' => '071101307',
                ),
                'individual' => array(
                    'address' => array(
                        'streetAddress' => '111 Main St',
                        'locality' => 'Chicago',
                        'postalCode' => '60622',
                        'region' => 'IL',
                    ),
                    'dateOfBirth' => '1981-11-19',
                    'email' => 'jane@14ladders.com',
                    'firstName' => 'Jane',
                    'lastName' => 'Doe',
                    'phone' => '5553334444',
                    'ssn' => '078-05-1120',
                ),
            ),
            'merchantAccountId' => "blue_ladders_store",
        );
        $data = $this->request->getData();

        $this->assertSame($expected, $data);
    }
}
