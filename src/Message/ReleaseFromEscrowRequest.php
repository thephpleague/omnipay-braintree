<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request.
 *
 * @method Response send()
 */
class ReleaseFromEscrowRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionId');

        return [
            'transactionId' => $this->getTransactionId(),
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
        $response = $this->braintree->transaction()->releaseFromEscrow($data['transactionId']);

        return $this->createResponse($response);
    }
}
