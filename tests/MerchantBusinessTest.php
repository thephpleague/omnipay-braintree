<?php

namespace Omnipay\Braintree;

use DateTime;
use DateTimeZone;
use Omnipay\Tests\TestCase;

class MerchantBusinessTest extends TestCase
{
    public function setUp()
    {
        $this->business = new MerchantBusiness();
    }
    
    public function testConstructWithParams()
    {
        $business = new MerchantBusiness(array('legalName' => 'Hoochie\s Dollar Store'));
        $this->assertSame('Hoochie\s Dollar Store', $business->getLegalName());
    }

    public function testInitializeWithParams()
    {
        $business = new MerchantBusiness;
        $business->initialize(array('legalName' => 'Hoochie\s Dollar Store'));
        $this->assertSame('Hoochie\s Dollar Store', $business->getLegalName());
    }

    public function testGetParamters()
    {
        $card = new MerchantBusiness(array(
            'legalName' => 'Hoochie\s Dollar Store',
            'address1' => '620 W South St',
            'city' => 'Millsburg',
            'state' => 'AR',
            'postCode' => '72015',
        ));

        $parameters = $card->getParameters();
        $this->assertSame('Hoochie\s Dollar Store', $parameters['legalName']);
        $this->assertSame('620 W South St', $parameters['address1']);
        $this->assertSame('Millsburg', $parameters['city']);
        $this->assertSame('AR', $parameters['state']);
        $this->assertSame('72015', $parameters['postCode']);
    }

    public function testDbaName()
    {
        $this->business->setDbaName('Hoochie\s Dollar Store');
        $this->assertEquals('Hoochie\s Dollar Store', $this->business->getDbaName());
    }

    public function testLegalName()
    {
        $this->business->setLegalName('Hoochie\s Dollar Store');
        $this->assertEquals('Hoochie\s Dollar Store', $this->business->getLegalName());
    }

    public function testPhone()
    {
        $this->business->setPhone('501.778.3151');
        $this->assertEquals('501.778.3151', $this->business->getPhone());
    }

    public function testTaxId()
    {
        $this->business->setTaxId('98-7654321');
        $this->assertEquals('98-7654321', $this->business->getTaxId());
    }

    public function testAddress1()
    {
        $this->business->setAddress1('620 W South St');
        $this->assertEquals('620 W South St', $this->business->getAddress1());
    }

    public function testCity()
    {
        $this->business->setCity('Millsburg');
        $this->assertEquals('Millsburg', $this->business->getCity());
    }

    public function testPostcode()
    {
        $this->business->setPostcode('72015');
        $this->assertEquals('72015', $this->business->getPostcode());
    }

    public function testState()
    {
        $this->business->setState('AR');
        $this->assertEquals('AR', $this->business->getState());
    }

    public function testEmail()
    {
        $this->business->setEmail('vaughn@HoochiesDollarStore.com');
        $this->assertEquals('vaughn@HoochiesDollarStore.com', $this->business->getEmail());
    }
}
