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
        $data = array();
        if ($customerId = $this->getCustomerId()) {
            $data['customerId'] = $customerId;
        }
        $data += $this->getOptionData();

        return $data;
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
