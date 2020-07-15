<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request.
 *
 * @method Response send()
 */
class VoidRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        return [
            'transactionReference' => $this->getTransactionReference(),
        ];
    }

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->braintree->transaction()->void($data['transactionReference']);

        return $this->createResponse($response);
    }
}
