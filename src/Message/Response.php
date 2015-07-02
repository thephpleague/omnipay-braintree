<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful()
    {
        if (isset($this->data->success)) {
            return $this->data->success;
        }

        return false;
    }

    public function getMessage()
    {
        if (isset($this->data->message) && $this->data->message) {
            return $this->data->message;
        }

        return null;
    }

    public function getCode()
    {
        if (isset($this->data->transaction) && $this->data->transaction) {
            return $this->data->transaction->status;
        }

        return null;
    }

    public function getTransactionReference()
    {
        if (isset($this->data->transaction) && $this->data->transaction) {
            return $this->data->transaction->id;
        }

        return null;
    }
}
