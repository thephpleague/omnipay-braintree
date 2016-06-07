<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Update PaymentMethod Request
 *
 * @method Response send()
 */
class UpdatePaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['token'] = $this->getToken();
        $options = $this->parameters->get('paymentMethodOptions');

        if (null !== $options) {
            $data['options'] = $options;
        }

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->braintree->paymentMethod()->update($data['token'], $data['options']);

        return $this->createResponse($response);
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPaymentMethodToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOptions(array $options = array())
    {
        return $this->setParameter('paymentMethodOptions', $options);
    }
}
