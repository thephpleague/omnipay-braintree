<?php

namespace Omnipay\Braintree\Message;

use Mockery;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    /**
     * @var AbstractRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = Mockery::mock('\Omnipay\Braintree\Message\AbstractRequest')->makePartial();
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
            array('token', 'abc123'),
            array('merchantId', 'abc123'),
            array('publicKey', 'abc123'),
            array('privateKey', 'abc123'),
            array('billingAddressId', 'abc123'),
            array('channel', 'abc123'),
            array('customFields', array('a' => 'b')),
            array('customerId', 'abc123'),
            array('descriptor', array('a' => 'b')),
            array('deviceData', 'abc123'),
            array('deviceSessionId', 'abc123'),
            array('merchantAccountId', 'abc123'),
            array('recurring', true),
            array('addBillingAddressToPaymentMethod', true),
            array('holdInEscrow', true),
            array('storeInVault', true),
            array('storeShippingAddressInVault', true),
            array('shippingAddressId', 'abc123'),
            array('taxAmount', '10.00'),
            array('taxExempt', true),
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
          array('recurring'),
          array('addBillingAddressToPaymentMethod'),
          array('holdInEscrow'),
          array('storeInVault'),
          array('storeInVaultOnSuccess'),
          array('storeShippingAddressInVault'),
        );
    }

    public function testCardData()
    {
        $card = array(
          'firstName' => 'Example',
          'lastName' => 'User',
          'company' => 'League',
          'billingAddress1' => '123 Billing St',
          'billingAddress2' => 'Billsville',
          'billingCity' => 'Billstown',
          'billingPostcode' => '12345',
          'billingState' => 'CA',
          'billingCountry' => 'US',
          'billingPhone' => '(555) 123-4567',
          'shippingAddress1' => '123 Shipping St',
          'shippingAddress2' => 'Shipsville',
          'shippingCity' => 'Shipstown',
          'shippingPostcode' => '54321',
          'shippingState' => 'NY',
          'shippingCountry' => 'US',
        );

        $this->request->setCard($card);
        $data = $this->request->getCardData();

        $this->assertSame($card['firstName'], $data['billing']['firstName']);
        $this->assertSame($card['lastName'], $data['billing']['lastName']);
        $this->assertSame($card['company'], $data['billing']['company']);
        $this->assertSame($card['billingAddress1'], $data['billing']['streetAddress']);
        $this->assertSame($card['billingAddress2'], $data['billing']['extendedAddress']);
        $this->assertSame($card['billingCity'], $data['billing']['locality']);
        $this->assertSame($card['billingPostcode'], $data['billing']['postalCode']);
        $this->assertSame($card['billingState'], $data['billing']['region']);
        $this->assertSame($card['billingCountry'], $data['billing']['countryName']);

        $this->assertSame($card['firstName'], $data['shipping']['firstName']);
        $this->assertSame($card['lastName'], $data['shipping']['lastName']);
        $this->assertSame($card['company'], $data['shipping']['company']);
        $this->assertSame($card['shippingAddress1'], $data['shipping']['streetAddress']);
        $this->assertSame($card['shippingAddress2'], $data['shipping']['extendedAddress']);
        $this->assertSame($card['shippingCity'], $data['shipping']['locality']);
        $this->assertSame($card['shippingPostcode'], $data['shipping']['postalCode']);
        $this->assertSame($card['shippingState'], $data['shipping']['region']);
        $this->assertSame($card['shippingCountry'], $data['shipping']['countryName']);

    }

    public function testOptionData()
    {
        $options = array(
            'addBillingAddressToPaymentMethod' => false,
            'makeDefault'                      => true,
            'failOnDuplicatePaymentMethod'     => true,
            'holdInEscrow'                     => false,
            'storeInVault'                     => true,
            'storeInVaultOnSuccess'            => false,
            'storeShippingAddressInVault'      => true,
            'verifyCard'                       => false,
            'verificationMerchantAccountId'    => true,
        );
        $this->request->initialize($options);
        $data = $this->request->getOptionData();

        $this->assertSame($options['addBillingAddressToPaymentMethod'], $data['options']['addBillingAddressToPaymentMethod']);
        $this->assertSame($options['makeDefault'], $data['options']['makeDefault']);
        $this->assertSame($options['failOnDuplicatePaymentMethod'], $data['options']['failOnDuplicatePaymentMethod']);
        $this->assertSame($options['holdInEscrow'], $data['options']['holdInEscrow']);
        $this->assertSame($options['storeInVault'], $data['options']['storeInVault']);
        $this->assertSame($options['storeInVaultOnSuccess'], $data['options']['storeInVaultOnSuccess']);
        $this->assertSame($options['storeShippingAddressInVault'], $data['options']['storeShippingAddressInVault']);
        $this->assertSame($options['verifyCard'], $data['options']['verifyCard']);
        $this->assertSame($options['verificationMerchantAccountId'], $data['options']['verificationMerchantAccountId']);
    }
}
