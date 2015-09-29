<?php
namespace Omnipay\Braintree\Message;

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
        $this->validate('amount', 'token');

        $data = [
            'amount' => $this->getAmount(),
            'billingAddressId' => $this->getBillingAddressId(),
            'channel' => $this->getChannel(),
            'customFields' => $this->getCustomFields(),
            'customerId' => $this->getCustomerId(),
            'descriptor' => $this->getDescriptor(),
            'deviceData' => $this->getDeviceData(),
            'deviceSessionId' => $this->getDeviceSessionId(),
            'merchantAccountId' => $this->getMerchantAccountId(),
            'options' => [
                'addBillingAddressToPaymentMethod' => $this->getAddBillingAddressToPaymentMethod(),
                'holdInEscrow' => $this->getHoldInEscrow(),
                'storeInVault' => $this->getStoreInVault(),
                'storeInVaultOnSuccess' => $this->getStoreInVaultOnSuccess(),
                'storeShippingAddressInVault' => $this->getStoreShippingAddressInVault(),
                'submitForSettlement' => false,
            ],
            'orderId' => $this->getTransactionId(),
            'purchaseOrderNumber' => $this->getPurchaseOrderNumber(),
            'recurring' => $this->getRecurring(),
            'shippingAddressId' => $this->getShippingAddressId(),
            'taxAmount' => $this->getTaxAmount(),
            'taxExempt' => $this->getTaxExempt(),
        ];

        if ($this->getUsePaymentMethodToken() === true) {
            $data['paymentMethodToken'] = $this->getToken();
        } else {
            $data['paymentMethodNonce'] = $this->getToken();
        }

        // Remove null values
        $data = array_filter($data, function($value){
            return ! is_null($value);
        });

        $data += $this->getCardData();

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
}
