<?php

namespace Omnipay\Braintree;

use DateTime;
use DateTimeZone;
use Omnipay\Common\Helper;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Data for an individual, used to create a MerchantAccount.
 *
 * The following parameters can be set:
 *
 * birthday
 * city
 * email
 * firstName
 * lastName
 * phone
 * postCode
 * state
 * ssn
 * streetAddress
 */
class MerchantIndividual
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
     * Get the individual's birthday.
     *
     * @return string
     */
    public function getBirthday($format = 'Y-m-d')
    {
        $value = $this->getParameter('birthday');

        return $value ? $value->format($format) : null;
    }

    /**
     * Sets the individual's birthday.
     *
     * @param string $value
     * @return $this
     */
    public function setBirthday($value)
    {
        if ($value) {
            $value = new DateTime($value, new DateTimeZone('UTC'));
        } else {
            $value = null;
        }

        return $this->setParameter('birthday', $value);
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->getParameter('city');
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->setParameter('city', $city);

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
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->getParameter('firstName');
    }

    /**
     * @param mixed $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->setParameter('firstName', $firstName);

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
     * @return mixed
     */
    public function getLastName()
    {
        return $this->getParameter('lastName');
    }

    /**
     * @param mixed $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->setParameter('lastName', $lastName);

        return $this;
    }

    /**
     * Get the individual's name.
     *
     * @return string
     */
    public function getName()
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }

    /**
     * Sets the individual name.
     *
     * @param string $value
     * @return $this
     */
    public function setName($value)
    {
        $names = explode(' ', $value, 2);
        $this->setFirstName($names[0]);
        $this->setLastName(isset($names[1]) ? $names[1] : null);

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
    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    /**
     * @param mixed $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->setParameter('phone', $phone);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->getParameter('postCode');
    }

    /**
     * @param mixed $postCode
     * @return $this
     */
    public function setPostCode($postCode)
    {
        $this->setParameter('postCode', $postCode);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->getParameter('state');
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->setParameter('state', $state);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSsn()
    {
        return $this->getParameter('ssn');
    }

    /**
     * @param mixed $ssn
     * @return $this
     */
    public function setSsn($ssn)
    {
        $this->setParameter('ssn', $ssn);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->getParameter('address1');
    }

    /**
     * @param mixed $streetAddress
     * @return $this
     */
    public function setAddress1($streetAddress)
    {
        $this->setParameter('address1', $streetAddress);

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