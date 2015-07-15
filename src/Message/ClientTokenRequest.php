<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 *
 * @method ClientTokenResponse send()
 */
class ClientTokenRequest extends AbstractRequest
{
    public function getData()
    {
        // TODO; customer data?
        return [];
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $token = $this->braintree->clientToken()->generate($data);

        return new ClientTokenResponse($this, $token);
    }
}
