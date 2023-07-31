<?php
namespace Omnipay\Braintree\Message;

/**
 * Authorize Request
 *
 * @method CustomerResponse send()
 */
class CreateCustomerRequest extends AbstractRequest
{
    public function getData()
    {
        $data = $this->getCustomerData();

        $data['creditCard'] = $this->getOptionData();

        $creditCard = $this->getCardData();

        if (array_key_exists('billing', $creditCard) && !empty($billingAddress = $creditCard['billing'])) {
            $data['creditCard']['billingAddress'] = [
                'company' => $billingAddress['company'],
                'countryCodeAlpha3' => $billingAddress['countryName'],
                'extendedAddress' => $billingAddress['extendedAddress'],
                'firstName' => $billingAddress['firstName'],
                'lastName' => $billingAddress['lastName'],
                'locality' => $billingAddress['locality'],
                'postalCode' => $billingAddress['postalCode'],
                'region' => $billingAddress['region'],
                'streetAddress' => $billingAddress['streetAddress'],
            ];
        }

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return CustomerResponse
     */
    public function sendData($data)
    {
        $response = $this->braintree->customer()->create($data);

        return $this->response = new CustomerResponse($this, $response);
    }
}
