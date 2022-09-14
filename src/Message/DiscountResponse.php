<?php
/**
 * DiscountResponse class.
 */
namespace Omnipay\Braintree\Message;

class DiscountResponse extends Response
{
    /**
     * Returns array of Braintree\Discount objects with available discounts
     * If there aren't any discounts created it will return empty array.
     *
     * @return array
     */
    public function getDiscountsData()
    {
        if (isset($this->data)) {
            return $this->data;
        }

        return [];
    }
}
