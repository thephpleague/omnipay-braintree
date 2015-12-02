<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Cancel Subscription Request
 *
 * @method CustomerResponse send()
 */
class CancelSubscriptionRequest extends AbstractRequest
{
    /** @var  string */
    protected $subscriptionId;

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->subscriptionId;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($subscriptionId)
    {
        $response = $this->braintree->subscription()->cancel($subscriptionId);

        return $this->response = new SubscriptionResponse($this, $response);
    }

    public function setId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }
}