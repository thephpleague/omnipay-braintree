<?php

namespace Omnipay\Braintree\Message;

use Braintree\TransactionSearch;
use Omnipay\Common\Message\ResponseInterface;

class SearchRequest extends AbstractRequest
{
    /**
     * Authorize Request
     *
     * @method Response send()
     */
    public function getData()
    {
        $this->validate('purchaseOrderNumber');

        return array(
            'purchaseOrderNumber' => $this->getPurchaseOrderNumber(),
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
        $response = $this->braintree->transaction()->search([
            TransactionSearch::orderId()->is($data['purchaseOrderNumber']),
        ]);

        $transactions = [];
        foreach($response as $transaction) {
            $transactions[] = $transaction;
        }

        return $this->createResponse($transactions);
    }
}