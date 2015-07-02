<?php

namespace Omnipay\Braintree\Message;

use Braintree_Configuration;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Set the correct configuration sending
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function send()
    {
        $this->configure();

        return parent::send();
    }

    public function configure()
    {
        // Reset to the initial state
        Braintree_Configuration::reset();

        // When in testMode, use the sandbox environment
        if ($this->getTestMode()) {
            Braintree_Configuration::environment('sandbox');
        } else {
            Braintree_Configuration::environment('production');
        }

        // Set the keys
        Braintree_Configuration::merchantId($this->getMerchantId());
        Braintree_Configuration::publicKey($this->getPublicKey());
        Braintree_Configuration::privateKey($this->getPrivateKey());
    }
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getPublicKey()
    {
        return $this->getParameter('publicKey');
    }

    public function setPublicKey($value)
    {
        return $this->setParameter('publicKey', $value);
    }

    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
