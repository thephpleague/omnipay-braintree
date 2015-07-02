<?php
namespace Omnipay\Braintree\Message;

use Braintree_Transaction;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'token');

        $data = [
            'amount' => $this->getAmount(),
            'paymentMethodNonce' => $this->getToken(),
            'options' => [],
        ];

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
        $response = Braintree_Transaction::sale($data);

        return $this->createResponse($response);
    }
}
