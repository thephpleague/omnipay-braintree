<?php

namespace Omnipay\Braintree;

class Item extends \Omnipay\Common\Item
{
    /**
     * {@inheritDoc}
     */
    public function getCommodityCode()
    {
        return $this->getParameter('commodityCode');
    }

    /**
     * Set the item commodity code
     */
    public function setCommodityCode($value)
    {
        return $this->setParameter('commodityCode', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiscountAmount()
    {
        return $this->getParameter('discountAmount');
    }

    /**
     * Set the item discount amount
     */
    public function setDiscountAmount($value)
    {
        return $this->setParameter('discountAmount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getKind()
    {
        return $this->getParameter('kind');
    }

    /**
     * Set the item kind
     */
    public function setKind($value)
    {
        return $this->setParameter('kind', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice()
    {
        return $this->getParameter('totalAmount');
    }

    /**
     * Set the item price
     */
    public function setPrice($value)
    {
        return $this->setParameter('totalAmount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductCode()
    {
        return $this->getParameter('productCode');
    }

    /**
     * Set the item product code
     */
    public function setProductCode($value)
    {
        return $this->setParameter('productCode', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getTaxAmount()
    {
        return $this->getParameter('taxAmount');
    }

    /**
     * Set the item tax amount
     */
    public function setTaxAmount($value)
    {
        return $this->setParameter('taxAmount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalAmount()
    {
        return $this->getPrice();
    }

    /**
     * Set the item price
     */
    public function setTotalAmount($value)
    {
        return $this->setPrice($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnitAmount()
    {
        return $this->getParameter('unitAmount');
    }

    /**
     * Set the item unit price
     */
    public function setUnitAmount($value)
    {
        return $this->setParameter('unitAmount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnitOfMeasure()
    {
        return $this->getParameter('unitOfMeasure');
    }

    /**
     * Set the item unit of measure
     */
    public function setUnitOfMeasure($value)
    {
        return $this->setParameter('unitOfMeasure', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnitTaxAmount()
    {
        return $this->getParameter('unitTaxAmount');
    }

    /**
     * Set the item unit tax amount
     */
    public function setUnitTaxAmount($value)
    {
        return $this->setParameter('unitTaxAmount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl()
    {
        return $this->getParameter('url');
    }

    /**
     * Set the item url
     */
    public function setUrl($value)
    {
        return $this->setParameter('url', $value);
    }
}
