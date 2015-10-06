<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class CustomerResponse extends Response
{
    public function getCustomerData()
    {
        return $this->data->customer;
    }
}
