<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Update PaymentMethod Request
 *
 * @method Response send()
 */
class UpdatePaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        $parameters = array();
        $parameters += $this->getOptionData();

        $data['token'] = $this->getToken();
        if (!empty($parameters)) {
            $data['parameters'] = $parameters;
        }

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
        $response = $this->braintree->paymentMethod()->update($data['token'], $data['parameters']);

        return $this->createResponse($response);
    }
}
