<?php
/**
 * TransactionsResponse class.
 */
namespace Omnipay\Braintree\Message;

class TransactionsResponse extends Response
{
    /**
     * Returns array of Braintree\Transaction objects with found transactions
     * If there aren't any transactions found, it will return empty array.
     *
     * @return array
     */
    public function getTransactionsData()
    {
        if (isset($this->data)) {
            return $this->data;
        }

        return [];
    }
}
