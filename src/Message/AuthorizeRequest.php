<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount');

        $data = array(
            'amount' => $this->getAmount(),
            'billingAddressId' => $this->getBillingAddressId(),
            'channel' => $this->getChannel(),
            'customFields' => $this->getCustomFields(),
            'customerId' => $this->getCustomerId(),
            'descriptor' => $this->getDescriptor(),
            'deviceData' => $this->getDeviceData(),
            'deviceSessionId' => $this->getDeviceSessionId(),
            'merchantAccountId' => $this->getMerchantAccountId(),
            'orderId' => $this->getTransactionId(),
            'purchaseOrderNumber' => $this->getPurchaseOrderNumber(),
            'recurring' => $this->getRecurring(),
            'serviceFeeAmount' => $this->getServiceFeeAmount(),
            'shippingAddressId' => $this->getShippingAddressId(),
            'taxAmount' => $this->getTaxAmount(),
            'taxExempt' => $this->getTaxExempt(),
        );

        // special validation
        if ($this->getPaymentMethodToken()) {
            $data['paymentMethodToken'] = $this->getPaymentMethodToken();
        } elseif ($this->getToken()) {
            $data['paymentMethodNonce'] = $this->getToken();
        } elseif ($this->getCustomerId()) {
            $data['customerId'] = $this->getCustomerId();
        } else {
            throw new InvalidRequestException("The token (payment nonce), paymentMethodToken or customerId field should be set.");
        }

        // Remove null values
        $data = array_filter($data, function($value){
            return ! is_null($value);
        });

        if ($this->getCardholderName()) {
            $data['creditCard'] = array(
                'cardholderName' => $this->getCardholderName(),
            );
        }

        $data += $this->getOptionData();
        $data += $this->getCardData();
        $data['options']['submitForSettlement'] = false;

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
        $response = $this->braintree->transaction()->sale($data);

        return $this->createResponse($response);
    }

    /**
     * [optional] The cardholder name associated with the credit card. 175 character maximum.
     * Required for iOS integration because its missing in "tokenizeCard" function there.
     * See: https://developers.braintreepayments.com/reference/request/transaction/sale/php#credit_card.cardholder_name
     *
     * @param $value
     * @return mixed
     */
    public function setCardholderName($value)
    {
        $cardholderName = trim($value);
        $cardholderName = strlen($cardholderName)>0 ? $cardholderName : null;
        return $this->setParameter('cardholderName', $cardholderName);
    }

    public function getCardholderName()
    {
        return $this->getParameter('cardholderName');
    }
}
