<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Create PaymentMethod Request
 *
 * @method Response send()
 */
class CreatePaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array(
            'customerId' => $this->getCustomerId(),
            'paymentMethodNonce' => $this->getToken(),
        );
        if ($cardholderName = $this->getCardholderName()) {
            $data['cardholderName'] = $cardholderName;
        }

        if ($this->getStreetAddress()!=='') {
            $data['billingAddress'] = [];
            $data['billingAddress']['streetAddress'] = $this->getStreetAddress();
        }
        if ($this->getLocality()!=='') {
            $data['billingAddress']['locality'] = $this->getLocality();
        }
        if ($this->getPostalCode()!=='') {
            $data['billingAddress']['postalCode'] = $this->getPostalCode();
        }
        if ($this->getRegion()!=='') {
            $data['billingAddress']['region'] = $this->getRegion();
        }
        if ($this->getCountryCodeAlpha2()!=='') {
            $data['billingAddress']['countryCodeAlpha2'] = $this->getCountryCodeAlpha2();
        }

        $data += $this->getOptionData();

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->braintree->paymentMethod()->create($data);

        return $this->createResponse($response);
    }

    /**
     * [optional] The cardholder name associated with the credit card. 175 character maximum.
     * Required for iOS integration because its missing in "tokenizeCard" function there.
     * See: https://developers.braintreepayments.com/reference/request/payment-method/create/php#cardholder_name
     *
     * @param $value
     * @return mixed
     */
    public function setCardholderName($value)
    {
        $cardholderName = trim($value);
        $cardholderName = strlen($cardholderName)>0 ? $cardholderName : null;
        return $this->setParameter('cardholderName', $cardholderName);
    }

    public function getCardholderName()
    {
        return $this->getParameter('cardholderName');
    }

    /*
     * Required for AVS Rules
    */
    public function getStreetAddress()
    {
        return $this->getParameter('streetAddress');
    }

    public function setStreetAddress($value)
    {
        return $this->setParameter('streetAddress', $value);
    }

    public function getLocality()
    {
        return $this->getParameter('locality');
    }

    public function setLocality($value)
    {
        return $this->setParameter('locality', $value);
    }

    public function getPostalCode()
    {
        return $this->getParameter('postalCode');
    }

    public function setPostalCode($value)
    {
        return $this->setParameter('postalCode', $value);
    }

    public function getRegion()
    {
        return $this->getParameter('region');
    }

    public function setRegion($value)
    {
        return $this->setParameter('region', $value);
    }

    public function getCountryCodeAlpha2()
    {
        return $this->getParameter('countryCodeAlpha2');
    }

    public function setCountryCodeAlpha2($value)
    {
        return $this->setParameter('countryCodeAlpha2', $value);
    }
}
