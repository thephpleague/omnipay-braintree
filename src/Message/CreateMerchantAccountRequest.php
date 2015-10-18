<?php
namespace Omnipay\Braintree\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Merchant account Request
 *
 * @method Response send()
 */
class CreateMerchantAccountRequest extends AbstractMerchantAccountRequest
{
    public function getData()
    {
        $data = array(
            'id' => $this->getMerchantAccountId(),
            'masterMerchantAccountId' => $this->getMasterMerchantAccountId(),
            'tosAccepted' => $this->getTosAccepted(),
        );
        // Remove null values
        $data = array_filter($data, function($value){
            return ! is_null($value);
        });
        $data += $this->getBusinessData() + $this->getFundingData() + $this->getIndividualData();

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
        $response = $this->braintree->merchantAccount()->create($data);

        return $this->response = new Response($this, $response);
    }
}
