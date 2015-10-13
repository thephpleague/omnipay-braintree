<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class DeleteCustomerRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->getCustomerId();
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->braintree->customer()->delete($data);

        return $this->createResponse($response);
    }
}
