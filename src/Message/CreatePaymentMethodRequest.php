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
}
