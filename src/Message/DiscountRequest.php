<?php

namespace Omnipay\Braintree\Message;

class DiscountRequest extends AbstractRequest
{
    /**
     * @return null
     */
    public function getData()
    {
        return null;
    }

    /**
     * @param null $data
     * @return DiscountResponse
     */
    public function sendData($data = null)
    {
        $response = $this->braintree->discount()->all();
        return $this->response = new DiscountResponse($this, $response);
    }
}