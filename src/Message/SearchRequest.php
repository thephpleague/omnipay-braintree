<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Search Transactions Request.
 *
 * @method Response send()
 */
class SearchRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('searchQuery');

        return $this->getSearchQuery();
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
        $response = $this->braintree->transaction()->search($data);

        return $this->response = new TransactionsResponse($this, $response);
    }

    public function setSearchQuery($value)
    {
        return $this->setParameter('searchQuery', $value);
    }

    public function getSearchQuery()
    {
        return $this->getParameter('searchQuery');
    }
}