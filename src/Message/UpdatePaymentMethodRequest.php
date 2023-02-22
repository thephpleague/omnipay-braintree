<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Update PaymentMethod Request.
 *
 * @method Response send()
 */
class UpdatePaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [];
        $data['token'] = $this->getToken();
        $options = $this->parameters->get('paymentMethodOptions');

        if (null !== $options) {
            $data['options'] = $options;
        }

        foreach (array('cardholderName', 'expirationDate') as $key) {
            $value = $this->parameters->get($key);

            if (null !== $value) {
                $data[$key] = $value;
            }
        }

        return $data;
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
        $response = $this->braintree->paymentMethod()->update($data['token'], $data);

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
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMakeDefault($value)
    {
        return $this->setOptions(['makeDefault' => (bool) $value]);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOptions(array $options = [])
    {
        return $this->setParameter('paymentMethodOptions', $options);
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCardholderName($value)
    {
        return $this->setParameter('cardholderName', $value);
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setExpirationDate($value)
    {
        return $this->setParameter('expirationDate', $value);
    }
}
