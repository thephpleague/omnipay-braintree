<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 * @method CustomerResponse send()
 */
class CreateAddressRequest extends AbstractRequest
{
    public function getData()
    {
        return array_merge($this->getCustomerData(), ['customerId' => $this->getCustomerId()]);
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->braintree->address()->create($data);

        return $this->response = new CustomerResponse($this, $response);
    }
}