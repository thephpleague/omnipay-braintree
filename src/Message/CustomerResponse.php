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
        return $this->data->customer;
    }
}
