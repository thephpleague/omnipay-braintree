<?php

namespace Omnipay\Braintree;

use Omnipay\Common\AbstractGateway;
use Braintree_Gateway;
use Braintree_Configuration;
use Guzzle\Http\ClientInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
/**
 * Braintree Gateway
 */
class Gateway extends AbstractGateway
{
    /**
     * @var \Braintree_Gateway
     */
    protected $braintree;

    /**
     * Create a new gateway instance
     *
     * @param ClientInterface $httpClient  A Guzzle client to make API calls with
     * @param HttpRequest     $httpRequest A Symfony HTTP request object
     * @param Braintree_Gateway $braintree The Braintree gateway
     */
    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null, Braintree_Gateway $braintree = null)
    {
        $this->braintree = $braintree ?: Braintree_Configuration::gateway();

        parent::__construct($httpClient, $httpRequest);
    }

    /**
     * {@inheritdoc}
     */
    protected function createRequest($class, array $parameters)
    {
        $obj = new $class($this->httpClient, $this->httpRequest, $this->braintree);

        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }

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
