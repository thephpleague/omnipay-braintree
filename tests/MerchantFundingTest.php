<?php

namespace Omnipay\Braintree;

use Braintree_MerchantAccount;
use Omnipay\Tests\TestCase;

class MerchantFundingTest extends TestCase
{
    public function setUp()
    {
        $this->funding = new MerchantFunding();
    }
    
    public function testConstructWithParams()
    {
        $funding = new MerchantFunding(array('descriptor' => 'Millsburg National Bank'));
        $this->assertSame('Millsburg National Bank', $funding->getDescriptor());
    }

    public function testInitializeWithParams()
    {
        $funding = new MerchantFunding;
        $funding->initialize(array('descriptor' => 'Millsburg National Bank'));
        $this->assertSame('Millsburg National Bank', $funding->getDescriptor());
    }

    public function testGetParamters()
    {
        $card = new MerchantFunding(array(
            'descriptor' => 'Millsburg National Bank',
            'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
            'email' => 'payment@hoochiesdollarstore.com',
            'mobilePhone' => '501.778.3151',
            'accountNumber' => '1123581321',
            'routingNumber' => '071101307'
        ));

        $parameters = $card->getParameters();
        $this->assertSame('Millsburg National Bank', $parameters['descriptor']);
        $this->assertSame(Braintree_MerchantAccount::FUNDING_DESTINATION_BANK, $parameters['destination']);
        $this->assertSame('payment@hoochiesdollarstore.com', $parameters['email']);
        $this->assertSame('501.778.3151', $parameters['mobilePhone']);
        $this->assertSame('1123581321', $parameters['accountNumber']);
        $this->assertSame('071101307', $parameters['routingNumber']);
    }

    public function testAccountNumber()
    {
        $this->funding->setAccountNumber('1123581321');
        $this->assertEquals('1123581321', $this->funding->getAccountNumber());
    }

    public function testRoutingNumber()
    {
        $this->funding->setRoutingNumber('071101307');
        $this->assertEquals('071101307', $this->funding->getRoutingNumber());
    }

    public function testMobilePhone()
    {
        $this->funding->setMobilePhone('501.778.3151');
        $this->assertEquals('501.778.3151', $this->funding->getMobilePhone());
    }

    public function testDescriptor()
    {
        $this->funding->setDescriptor('Millsburg National Bank');
        $this->assertEquals('Millsburg National Bank', $this->funding->getDescriptor());
    }

    public function testDestination()
    {
        $this->funding->setDestination(Braintree_MerchantAccount::FUNDING_DESTINATION_BANK);
        $this->assertEquals(Braintree_MerchantAccount::FUNDING_DESTINATION_BANK, $this->funding->getDestination());
    }

    public function testEmail()
    {
        $this->funding->setEmail('payment@hoochiesdollarstore.com');
        $this->assertEquals('payment@hoochiesdollarstore.com', $this->funding->getEmail());
    }
}
