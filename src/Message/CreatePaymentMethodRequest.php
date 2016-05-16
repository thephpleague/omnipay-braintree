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
}
