<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request.
 *
 * @method Response send()
 */
class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        return [
            'transactionReference' => $this->getTransactionReference(),
            'amount' => $this->getAmount(),
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
        $response = $this->braintree->transaction()->submitForSettlement($data['transactionReference'], $data['amount']);

        return $this->createResponse($response);
    }
}
