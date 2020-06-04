<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Braintree\MerchantAccount;
use Braintree_MerchantAccount;
use Omnipay\Tests\TestCase;

class CreateMerchantAccountRequestTest extends TestCase
{
    /**
     * @var CreateMerchantAccountRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new CreateMerchantAccountRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
        $this->request->initialize(
            [
                'individual' => [
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
                ],
                'business' => [
                    'legalName' => 'Jane\'s Ladders',
                    'dbaName' => 'Jane\'s Ladders',
                    'taxId' => '98-7654321',
                    'address1' => '111 Main St',
                    'city' => 'Chicago',
                    'state' => 'IL',
                    'postCode' => '60622',
                ],
                'funding' => [
                    'descriptor' => 'Blue Ladders',
                    'destination' => MerchantAccount::FUNDING_DESTINATION_BANK,
                    'email' => 'funding@blueladders.com',
                    'mobilePhone' => '5555555555',
                    'accountNumber' => '1123581321',
                    'routingNumber' => '071101307',
                ],
                'tosAccepted' => true,
                'masterMerchantAccountId' => '14ladders_marketplace',
            ]
        );
    }

    public function testGetData()
    {
        $expected = [
            'business' => [
                'address' => [
                    'streetAddress' => '111 Main St',
                    'locality' => 'Chicago',
                    'postalCode' => '60622',
                    'region' => 'IL',
                ],
                'dbaName' => 'Jane\'s Ladders',
                'legalName' => 'Jane\'s Ladders',
                'taxId' => '98-7654321',
            ],
            'funding' => [
                'accountNumber' => '1123581321',
                'descriptor' => 'Blue Ladders',
                'destination' => MerchantAccount::FUNDING_DESTINATION_BANK,
                'email' => 'funding@blueladders.com',
                'mobilePhone' => '5555555555',
                'routingNumber' => '071101307',
            ],
            'individual' => [
                'address' => [
                    'streetAddress' => '111 Main St',
                    'locality' => 'Chicago',
                    'postalCode' => '60622',
                    'region' => 'IL',
                ],
                'dateOfBirth' => '1981-11-19',
                'email' => 'jane@14ladders.com',
                'firstName' => 'Jane',
                'lastName' => 'Doe',
                'phone' => '5553334444',
                'ssn' => '078-05-1120',
            ],
            'masterMerchantAccountId' => "14ladders_marketplace",
            'tosAccepted' => true,
        ];

        $data = $this->request->getData();

        $this->assertEquals($expected, $data);
    }
}
