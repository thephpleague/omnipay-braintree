<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Delete PaymentMethod Request
 *
 * @method Response send()
 */
class DeletePaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->getToken();
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->braintree->paymentMethod()->delete($data);

        return $this->createResponse($response);
    }
}
