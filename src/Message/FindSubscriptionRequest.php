<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Find Subscription Request
 * @method SubscriptionResponse send()
 */
class FindSubscriptionRequest extends AbstractRequest
{
    /** @var  string */
    protected $subscriptionId;

    public function getData()
    {
        return $this->subscriptionId;
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data
     *
     * @return SubscriptionResponse|ResponseInterface
     */
    public function sendData($subscriptionId)
    {
        $response = $this->braintree->subscription()->find($subscriptionId);

        return $this->response = new SubscriptionResponse($this, $response);
    }

    public function setId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }
}
