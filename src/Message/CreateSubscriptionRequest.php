<?php
namespace Omnipay\Braintree\Message;

/**
 * Create Subscription Request
 *
 * @method CustomerResponse send()
 */
class CreateSubscriptionRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->getSubscriptionData();
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return SubscriptionResponse
     */
    public function sendData($data)
    {
        $response = $this->braintree->subscription()->create($data);

        return $this->response = new SubscriptionResponse($this, $response);
    }

    public function setSubscriptionData($value)
    {
        return $this->setParameter('subscriptionData', $value);
    }

    public function getSubscriptionData()
    {
        return $this->getParameter('subscriptionData');
    }
}