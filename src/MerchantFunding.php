<?php

namespace Omnipay\Braintree;

use DateTime;
use DateTimeZone;
use Omnipay\Common\Helper;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Data for funding, used to create a MerchantAccount.
 *
 * The following parameters can be set:
 *
 * accountNumber
 * descriptor
 * destination
 * email
 * mobilePhone
 * routingNumber
 */
class MerchantFunding
{
    /**
     * Internal storage of all of the individual parameters.
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * Create a new MerchantIndividual object using the specified parameters
     *
     * @param array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->getParameter('accountNumber');
    }

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->setParameter('accountNumber', $accountNumber);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptor()
    {
        return $this->getParameter('descriptor');
    }

    /**
     * @param string $descriptor
     * @return $this
     */
    public function setDescriptor($descriptor)
    {
        $this->setParameter('descriptor', $descriptor);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->getParameter('destination');
    }

    /**
     * @param string $destination
     * @return $this
     */
    public function setDestination($destination)
    {
        $this->setParameter('destination', $destination);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param mixed $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->setParameter('email', $email);

        return $this;
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return CreditCard provides a fluent interface.
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag();

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * Get all parameters.
     *
     * @return array An associative array of parameters.
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * @return mixed
     */
    public function getMobilePhone()
    {
        return $this->getParameter('mobilePhone');
    }

    /**
     * @param string $mobilePhone
     * @return $this
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->setParameter('mobilePhone', $mobilePhone);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoutingNumber()
    {
        return $this->getParameter('routingNumber');
    }

    /**
     * @param string $routingNumber
     * @return $this
     */
    public function setRoutingNumber($routingNumber)
    {
        $this->setParameter('routingNumber', $routingNumber);

        return $this;
    }

    /**
     * Get one parameter.
     *
     * @return mixed A single parameter value.
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * Set one parameter.
     *
     * @param string $key Parameter key
     * @param mixed $value Parameter value
     * @return CreditCard provides a fluent interface.
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }
}