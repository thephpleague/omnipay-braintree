<?php

namespace Omnipay\Braintree\Message;

use Braintree\Exception\NotFound;
use Omnipay\Common\Exception\NotFoundException;

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
     * @throws \Omnipay\Common\Exception\NotFoundException
     */
    public function sendData($data)
    {
        try {
            $response = $this->braintree->customer()->find($this->getCustomerId());
        } catch (NotFound $exception) {
            throw new NotFoundException($exception->getMessage());
        }

        return $this->response = new CustomerResponse($this, $response);
    }
}