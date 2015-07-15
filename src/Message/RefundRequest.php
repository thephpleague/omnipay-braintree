<?php
namespace Omnipay\Braintree\Message;

use Braintree_Transaction;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        return array(
            'transactionReference' => $this->getTransactionReference(),
            'amount' => $this->getAmount(),
        );
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = Braintree_Transaction::void($data['transactionReference'], $data['amount']);

        return $this->createResponse($response);
    }
}
