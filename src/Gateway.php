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
     * @param string $id
     * @return Message\FindCustomerRequest
     */
    public function findCustomer($id)
    {
        return $this->createRequest('\Omnipay\Braintree\Message\FindCustomerRequest', array('customerId' => $id));
    }

    /**
     * @param array $parameters
     * @return Message\CreateCustomerRequest
     */
    public function createCustomer(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CreateCustomerRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\DeleteCustomerRequest
     */
    public function deleteCustomer(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\DeleteCustomerRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\UpdateCustomerRequest
     */
    public function updateCustomer(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\UpdateCustomerRequest', $parameters);
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
     * @return Message\CreateMerchantAccountRequest
     */
    public function createMerchantAccount(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CreateMerchantAccountRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\UpdateMerchantAccountRequest
     */
    public function updateMerchantAccount(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\UpdateMerchantAccountRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\CreatePaymentMethodRequest
     */
    public function createPaymentMethod(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CreatePaymentMethodRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\DeletePaymentMethodRequest
     */
    public function deletePaymentMethod(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\DeletePaymentMethodRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\UpdatePaymentMethodRequest
     */
    public function updatePaymentMethod(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\UpdatePaymentMethodRequest', $parameters);
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
    public function releaseFromEscrow(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\ReleaseFromEscrowRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\PurchaseRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\VoidRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createSubscription(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CreateSubscriptionRequest', $parameters);
    }

    /**
     * @param string $subscriptionId
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function cancelSubscription($subscriptionId)
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CancelSubscriptionRequest', array('id' => $subscriptionId));
    }

    /**
     * @return \Omnipay\Common\Message\PlansRequest
     */
    public function plans()
    {
        return $this->createRequest('\Omnipay\Braintree\Message\PlanRequest', array());
    }

    /**
     * @param array $parameters
     *
     * @return \Braintree_WebhookNotification
     *
     * @throws \Braintree_Exception_InvalidSignature
     */
    public function parseNotification(array $parameters = array())
    {
        return \Braintree_WebhookNotification::parse(
            $parameters['bt_signature'],
            $parameters['bt_payload']
        );
    }

    /**
     * @param array $parameters
     * @return Message\FindRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Braintree\Message\FindRequest', $parameters);
    }
}
