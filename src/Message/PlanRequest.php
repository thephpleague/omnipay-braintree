<?php
/**
 * PlanRequest Class
 */

namespace Omnipay\Braintree\Message;

class PlanRequest extends AbstractRequest
{
    /**
     * @return null
     */
    public function getData()
    {
        return null;
    }

    /**
     * @param null $data
     * @return PlanResponse
     */
    public function sendData($data = null)
    {
        $response = $this->braintree->plan()->all();
        return $this->response = new PlanResponse($this, $response);
    }
}