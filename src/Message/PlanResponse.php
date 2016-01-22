<?php
/**
 * PlanResponse class
 */
namespace Omnipay\Braintree\Message;


class PlanResponse extends Response
{
    /**
     * Returns array of Braintree_Plans objects with available plans
     * If there aren't any plans created it will return empty array
     * @return array
     */
    public function getPlansData()
    {
        if (isset($this->data)) {
            return $this->data;
        }
        return array();
    }
}