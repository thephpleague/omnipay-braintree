<?php

namespace Omnipay\Braintree\Message;

/**
 * Find Customer Request
 * @method CustomerResponse send()
 */
class FindCustomerRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->getCustomerData();
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data
     *
     * @return \Omnipay\Braintree\Message\CustomerResponse|\Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->braintree->customer()->find($this->getCustomerId());

        return $this->response = new CustomerResponse($this, $response);
    }
}
