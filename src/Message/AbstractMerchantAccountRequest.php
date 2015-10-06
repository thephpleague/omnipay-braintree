<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Braintree\MerchantBusiness;
use Omnipay\Braintree\MerchantFunding;
use Omnipay\Braintree\MerchantIndividual;

abstract class AbstractMerchantAccountRequest extends AbstractRequest
{
    /**
     * @return MerchantBusiness
     */
    public function getBusiness()
    {
        return $this->parameters->get('business');
    }

    /**
     * Get the business data.
     *
     * @return array
     */
    public function getBusinessData()
    {
        $business = $this->getBusiness();

        if (!$business) {
            return array();
        }

        $data = array(
            'address' => array(
                'streetAddress' => $business->getAddress1(),
                'locality' => $business->getCity(),
                'postalCode' => $business->getPostCode(),
                'region' => $business->getState(),
            ),
            'dbaName' => $business->getDbaName(),
            'email' => $business->getEmail(),
            'legalName' => $business->getLegalName(),
            'taxId' => $business->getTaxId(),
        );

        // Remove null values
        $data = array_filter($data, function($value){
            return ! is_null($value);
        });

        if (empty($data)) {
            return $data;
        } else {
            return array('business' => $data);
        }
    }

    /**
     * Sets the business.
     *
     * @param MerchantBusiness|array $value
     * @return $this
     */
    public function setBusiness($value)
    {
        if ($value && !$value instanceof MerchantBusiness) {
            $value = new MerchantBusiness($value);
        }

        return $this->setParameter('business', $value);
    }
    /**
     * @return MerchantFunding
     */
    public function getFunding()
    {
        return $this->parameters->get('funding');
    }

    /**
     * Get the funding data.
     *
     * @return array
     */
    public function getFundingData()
    {
        $funding = $this->getFunding();

        if (!$funding) {
            return array();
        }

        $data = array(
            'accountNumber' => $funding->getAccountNumber(),
            'descriptor' => $funding->getDescriptor(),
            'destination' => $funding->getDestination(),
            'email' => $funding->getEmail(),
            'mobilePhone' => $funding->getMobilePhone(),
            'routingNumber' =>  $funding->getRoutingNumber(),
        );

        // Remove null values
        $data = array_filter($data, function($value){
            return ! is_null($value);
        });

        if (empty($data)) {
            return $data;
        } else {
            return array('funding' => $data);
        }
    }

    /**
     * Sets the funding.
     *
     * @param MerchantFunding|array $value
     * @return $this
     */
    public function setFunding($value)
    {
        if ($value && !$value instanceof MerchantFunding) {
            $value = new MerchantFunding($value);
        }

        return $this->setParameter('funding', $value);
    }
    
    /**
     * @return MerchantIndividual
     */
    public function getIndividual()
    {
        return $this->parameters->get('individual');
    }

    /**
     * Get the individual data.
     *
     * @return array
     */
    public function getIndividualData()
    {
        $individual = $this->getIndividual();

        if (!$individual) {
            return array();
        }

        $data = array(
            'address' => array(
                'streetAddress' => $individual->getAddress1(),
                'locality' => $individual->getCity(),
                'postalCode' => $individual->getPostCode(),
                'region' => $individual->getState(),
            ),
            'dateOfBirth' => $individual->getBirthday(),
            'email' => $individual->getEmail(),
            'firstName' => $individual->getFirstName(),
            'lastName' => $individual->getLastName(),
            'phone' => $individual->getPhone(),
            'ssn' => $individual->getSsn(),
        );

        // Remove null values
        $data = array_filter($data, function($value){
            return ! is_null($value);
        });

        if (empty($data)) {
            return $data;
        } else {
            return array('individual' => $data);
        }
    }

    /**
     * Sets the individual.
     *
     * @param MerchantIndividual|array $value
     * @return $this
     */
    public function setIndividual($value)
    {
        if ($value && !$value instanceof MerchantIndividual) {
            $value = new MerchantIndividual($value);
        }

        return $this->setParameter('individual', $value);
    }

    /**
     * @return mixed
     */
    public function getMasterMerchantAccountId()
    {
        return $this->parameters->get('masterMerchantAccountId');
    }

    /**
     * @param string $masterMerchantAccountId
     * @return $this
     */
    public function setMasterMerchantAccountId($masterMerchantAccountId)
    {
        $this->parameters->set('masterMerchantAccountId', $masterMerchantAccountId);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTosAccepted()
    {
        return $this->parameters->get('tosAccepted') === true ? true : false;
    }

    /**
     * @param bool $tosAccepted
     * @return $this
     */
    public function setTosAccepted($tosAccepted)
    {
        $this->parameters->set('tosAccepted', (bool) $tosAccepted);

        return $this;
    }
}