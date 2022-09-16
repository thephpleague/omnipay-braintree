<?php

namespace Omnipay\Braintree;

use Braintree\Gateway as BraintreeGateway;

trait ConfigurationAwareTrait
{
    abstract public function getBraintree(): BraintreeGateway;
    abstract public function getTestMode();
    abstract public function getMerchantId();
    abstract public function getPublicKey();
    abstract public function getPrivateKey();

    public function configure()
    {
        // When in testMode, use the sandbox environment
        if ($this->getTestMode()) {
            $this->getBraintree()->config->environment('sandbox');
        } else {
            $this->getBraintree()->config->environment('production');
        }

        // Set the keys
        $this->getBraintree()->config->merchantId($this->getMerchantId());
        $this->getBraintree()->config->publicKey($this->getPublicKey());
        $this->getBraintree()->config->privateKey($this->getPrivateKey());
    }
}