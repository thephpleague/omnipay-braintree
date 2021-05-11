<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Create PaymentMethod Request.
 *
 * @method Response send()
 */
class CreatePaymentMethodRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $data = [
            'customerId' => $this->getCustomerId(),
            'paymentMethodNonce' => $this->getToken(),
        ];

        $cardholderName = $this->getCardholderName();

        if ($cardholderName) {
            $data['cardholderName'] = $cardholderName;
        }

        $data['billingAddress'] = [];

        if ($this->getStreetAddress() !== NULL && $this->getStreetAddress() !== '') {
            $data['billingAddress']['streetAddress'] = $this->getStreetAddress();
        }

        if ($this->getLocality() !== NULL && $this->getLocality() !== '') {
            $data['billingAddress']['locality'] = $this->getLocality();
        }

        if ($this->getPostalCode() !== NULL && $this->getPostalCode() !== '') {
            $data['billingAddress']['postalCode'] = $this->getPostalCode();
        }

        if ($this->getRegion() !== NULL && $this->getRegion() !== '') {
            $data['billingAddress']['region'] = $this->getRegion();
        }

        if ($this->getCountryCodeAlpha2() !== NULL && $this->getCountryCodeAlpha2() !== '') {
            $data['billingAddress']['countryCodeAlpha2'] = $this->getCountryCodeAlpha2();
        }

        if (count($data['billingAddress']) === 0) {
            unset($data['billingAddress']);
        }

        $data = array_merge($data, $this->getOptionData());

        return $data;
    }

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
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
     * See: https://developers.braintreepayments.com/reference/request/payment-method/create/php#cardholder_name.
     *
     * @param $value
     *
     * @return mixed
     */
    public function setCardholderName($value)
    {
        $cardholderName = trim($value);
        $cardholderName = strlen($cardholderName) > 0 ? $cardholderName : null;

        return $this->setParameter('cardholderName', $cardholderName);
    }

    /**
     * @return mixed
     */
    public function getCardholderName()
    {
        return $this->getParameter('cardholderName');
    }

    /*
     * Required for AVS Rules
    */

    /**
     * @return mixed
     */
    public function getStreetAddress()
    {
        return $this->getParameter('streetAddress');
    }

    /**
     * @param $value
     * @return CreatePaymentMethodRequest
     */
    public function setStreetAddress($value)
    {
        return $this->setParameter('streetAddress', $value);
    }

    /**
     * @return mixed
     */
    public function getLocality()
    {
        return $this->getParameter('locality');
    }

    /**
     * @param $value
     * @return CreatePaymentMethodRequest
     */
    public function setLocality($value)
    {
        return $this->setParameter('locality', $value);
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->getParameter('postalCode');
    }

    /**
     * @param $value
     * @return CreatePaymentMethodRequest
     */
    public function setPostalCode($value)
    {
        return $this->setParameter('postalCode', $value);
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->getParameter('region');
    }

    /**
     * @param $value
     * @return CreatePaymentMethodRequest
     */
    public function setRegion($value)
    {
        return $this->setParameter('region', $value);
    }

    /**
     * @return mixed
     */
    public function getCountryCodeAlpha2()
    {
        return $this->getParameter('countryCodeAlpha2');
    }

    /**
     * @param $value
     * @return CreatePaymentMethodRequest
     */
    public function setCountryCodeAlpha2($value)
    {
        return $this->setParameter('countryCodeAlpha2', $value);
    }
}
