<?php

namespace Omnipay\Braintree\Message;

use Braintree\Exception\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function sendData($data)
    {
        try {
            $response = $this->braintree->customer()->find($this->getCustomerId());
        } catch (NotFound $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        return $this->response = new CustomerResponse($this, $response);
    }
}