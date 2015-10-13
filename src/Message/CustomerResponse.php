<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * CustomerResponse
 */
class CustomerResponse extends Response
{
    public function getCustomerData()
    {
        if (isset($this->data->customer)) {
            return $this->data->customer;
        }

        return null;
    }
}
