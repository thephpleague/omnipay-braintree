<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 * @method CustomerResponse send()
 */
class UpdateAddressRequest extends AbstractRequest
{
    public function getData()
    {
        return [
            'customerId'   => $this->getCustomerId(),
            'addressId'    => $this->getBillingAddressId(),
            'customerData' => $this->getCustomerData()
        ];
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
        $response = $this->braintree->address()->update($data['customerId'], $data['addressId'], $data['customerData']);

        return $this->response = new CustomerResponse($this, $response);
    }
}