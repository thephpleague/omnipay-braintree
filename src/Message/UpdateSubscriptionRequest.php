<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request.
 *
 * @method CustomerResponse send()
 */
class UpdateSubscriptionRequest extends AbstractRequest
{
    /** @var  string */
    protected $subscriptionId;

    public function getData()
    {
        return [
            'subscriptionData' => $this->getSubscriptionData(),
            'subscriptionId' => $this->subscriptionId,
        ];
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
        $response = $this->braintree->subscription()->update($data['subscriptionId'], $data['subscriptionData']);

        return $this->response = new SubscriptionResponse($this, $response);
    }

    public function setId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
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
