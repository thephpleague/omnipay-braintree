<?php

namespace Omnipay\Braintree;

use DateTime;
use DateTimeZone;
use Omnipay\Tests\TestCase;

class MerchantIndividualTest extends TestCase
{
    public function setUp()
    {
        $this->individual = new MerchantIndividual();
    }
    
    public function testConstructWithParams()
    {
        $individual = new MerchantIndividual(array('name' => 'Karl Childers'));
        $this->assertSame('Karl Childers', $individual->getName());
    }

    public function testInitializeWithParams()
    {
        $individual = new MerchantIndividual;
        $individual->initialize(array('name' => 'Karl Childers'));
        $this->assertSame('Karl Childers', $individual->getName());
    }

    public function testGetParamters()
    {
        $card = new MerchantIndividual(array(
            'name' => 'Karl Childers',
            'address1' => '522 South Main Street',
            'city' => 'Millsburg',
            'state' => 'AR',
            'postCode' => '72015',
            'birthday' => '1996-11-27',
        ));

        $parameters = $card->getParameters();
        $this->assertSame('Karl', $parameters['firstName']);
        $this->assertSame('Childers', $parameters['lastName']);
        $this->assertSame('522 South Main Street', $parameters['address1']);
        $this->assertSame('Millsburg', $parameters['city']);
        $this->assertSame('AR', $parameters['state']);
        $this->assertSame('72015', $parameters['postCode']);
        $this->assertEquals(new DateTime('1996-11-27', new DateTimeZone('UTC')), $parameters['birthday']);
    }

    public function testFirstName()
    {
        $this->individual->setFirstName('Karl');
        $this->assertEquals('Karl', $this->individual->getFirstName());
    }

    public function testLastName()
    {
        $this->individual->setLastName('Childers');
        $this->assertEquals('Childers', $this->individual->getLastName());
    }

    public function testGetName()
    {
        $this->individual->setFirstName('Karl');
        $this->individual->setLastName('Childers');
        $this->assertEquals('Karl Childers', $this->individual->getName());
    }

    public function testSetName()
    {
        $this->individual->setName('Karl Childers');
        $this->assertEquals('Karl', $this->individual->getFirstName());
        $this->assertEquals('Childers', $this->individual->getLastName());
    }

    public function testSetNameWithOneName()
    {
        $this->individual->setName('Morris');
        $this->assertEquals('Morris', $this->individual->getFirstName());
        $this->assertEquals('', $this->individual->getLastName());
    }

    public function testSetNameWithMultipleNames()
    {
        $this->individual->setName('Billy Bob Thornton');
        $this->assertEquals('Billy', $this->individual->getFirstName());
        $this->assertEquals('Bob Thornton', $this->individual->getLastName());
    }

    public function testPhone()
    {
        $this->individual->setPhone('911');
        $this->assertEquals('911', $this->individual->getPhone());
    }

    public function testSsn()
    {
        $this->individual->setSsn('078.05.1120');
        $this->assertEquals('078.05.1120', $this->individual->getSsn());
    }

    public function testAddress1()
    {
        $this->individual->setAddress1('522 South Main Street');
        $this->assertEquals('522 South Main Street', $this->individual->getAddress1());
    }

    public function testCity()
    {
        $this->individual->setCity('Millsburg');
        $this->assertEquals('Millsburg', $this->individual->getCity());
    }

    public function testPostcode()
    {
        $this->individual->setPostcode('72015');
        $this->assertEquals('72015', $this->individual->getPostcode());
    }

    public function testState()
    {
        $this->individual->setState('AR');
        $this->assertEquals('AR', $this->individual->getState());
    }

    public function testEmail()
    {
        $this->individual->setEmail('karl@NervousHospital.com');
        $this->assertEquals('karl@NervousHospital.com', $this->individual->getEmail());
    }

    public function testBirthday()
    {
        $this->individual->setBirthday('1996-11-27');
        $this->assertEquals('1996-11-27', $this->individual->getBirthday());
        $this->assertEquals('1996.11.27', $this->individual->getBirthday('Y.m.d'));
    }

    public function testBirthdayEmpty()
    {
        $this->individual->setBirthday('');
        $this->assertNull($this->individual->getBirthday());
    }
}
