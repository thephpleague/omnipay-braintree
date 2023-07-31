<?php

namespace Omnipay\Braintree\Message;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class PurchaseRequest extends AuthorizeRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['options']['submitForSettlement']       = true;
        $data['options']['skipAdvancedFraudChecking'] = $this->getSkipAdvancedFraudChecking();

        return $data;
    }

    public function setSkipAdvancedFraudChecking($value)
    {
        return $this->setParameter('skipAdvancedFraudChecking', (bool)$value);
    }

    public function getSkipAdvancedFraudChecking()
    {
        return (bool)$this->getParameter('skipAdvancedFraudChecking');
    }
}
