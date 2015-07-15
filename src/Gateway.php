<?php

namespace Omnipay\Braintree;

use Omnipay\Common\AbstractGateway;

/**
 * Braintree Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Braintree';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'publicKey' => '',
            'privateKey' => '',
            'testMode' => false,
        );
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

    /**
     * @param array $parameters
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\AuthorizeRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\PurchaseRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CaptureRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\ClientTokenRequest
     */
    public function clientToken(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\ClientTokenRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\PurchaseRequest
     */
    public function find(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\FindRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\PurchaseRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\RefundRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\PurchaseRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\VoidRequest', $parameters);
    }
}
