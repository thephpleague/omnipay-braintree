<?php
namespace Omnipay\Braintree\Message;

/**
 * Authorize Request
 *
 * @method CustomerResponse send()
 */
class CreateCustomerRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->getCustomerData();
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return CustomerResponse
     */
    public function sendData($data)
    {
        $response = $this->braintree->customer()->create($data);

        return $this->response = new CustomerResponse($this, $response);
    }
}
