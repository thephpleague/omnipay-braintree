<?php

namespace Omnipay\Braintree;

use Braintree\Configuration;
use Braintree\Gateway as BraintreeGateway;
use Braintree\WebhookNotification;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Http\ClientInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
/**
 * Braintree Gateway.
 */
class Gateway extends AbstractGateway
{
    /**
     * @var BraintreeGateway
     */
    protected $braintree;

    /**
     * Create a new gateway instance.
     *
     * @param ClientInterface  $httpClient  A Guzzle client to make API calls with
     * @param HttpRequest      $httpRequest A Symfony HTTP request object
     * @param BraintreeGateway $braintree   The Braintree gateway
     */
    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null, BraintreeGateway $braintree = null)
    {
        $this->braintree = $braintree ?: Configuration::gateway();

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
        return [
            'merchantId' => '',
            'publicKey' => '',
            'privateKey' => '',
            'testMode' => false,
        ];
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
     *
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\AuthorizeRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\PurchaseRequest
     */
    public function capture(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CaptureRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\ClientTokenRequest
     */
    public function clientToken(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\ClientTokenRequest', $parameters);
    }

    /**
     * @param string $id
     *
     * @return Message\FindCustomerRequest
     */
    public function findCustomer($id)
    {
        return $this->createRequest('\Omnipay\Braintree\Message\FindCustomerRequest', array('customerId' => $id));
    }

    /**
     * @param array $parameters
     *
     * @return Message\CreateCustomerRequest
     */
    public function createCustomer(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CreateCustomerRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\DeleteCustomerRequest
     */
    public function deleteCustomer(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\DeleteCustomerRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\UpdateCustomerRequest
     */
    public function updateCustomer(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\UpdateCustomerRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\PurchaseRequest
     */
    public function find(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\FindRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\CreateMerchantAccountRequest
     */
    public function createMerchantAccount(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CreateMerchantAccountRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\UpdateMerchantAccountRequest
     */
    public function updateMerchantAccount(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\UpdateMerchantAccountRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\CreatePaymentMethodRequest
     */
    public function createPaymentMethod(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\CreatePaymentMethodRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\DeletePaymentMethodRequest
     */
    public function deletePaymentMethod(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\DeletePaymentMethodRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\UpdatePaymentMethodRequest
     */
    public function updatePaymentMethod(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\UpdatePaymentMethodRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\PurchaseRequest
     */
    public function refund(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\RefundRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\PurchaseRequest
     */
    public function releaseFromEscrow(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\ReleaseFromEscrowRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return Message\PurchaseRequest
     */
    public function void(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\VoidRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createSubscription(array $parameters = [])
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
        return $this->createRequest('\Omnipay\Braintree\Message\PlanRequest', []);
    }

    /**
     * @param array $parameters
     *
     * @return WebhookNotification
     *
     * @throws \Braintree\Exception\InvalidSignature
     */
    public function parseNotification(array $parameters = [])
    {
        return WebhookNotification::parse(
            $parameters['bt_signature'],
            $parameters['bt_payload']
        );
    }

    /**
     * @param array $parameters
     *
     * @return Message\FindRequest
     */
    public function fetchTransaction(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Braintree\Message\FindRequest', $parameters);
    }
}
