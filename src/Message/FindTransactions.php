<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

class FindTransactions extends AbstractRequest
{
    public function getData()
    {
        $parameters = $this->getParameters();

        $data = array();

        foreach ($parameters as $parameterName => $value) {
            if (method_exists('Braintree_TransactionSearch', $parameterName)) {
                $search = call_user_func("\Braintree_TransactionSearch::$parameterName");
                $data[] = $search->is($value);
            }
        }
        return $data;
    }

    public function sendData($data)
    {
        $response = $this->braintree->transaction()->search($data);

        return $this->createResponse($response);
    }
}
