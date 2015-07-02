<?php

namespace PHPSTORM_META {

    /** @noinspection PhpIllegalArrayKeyTypeInspection */
    /** @noinspection PhpUnusedLocalVariableInspection */
    $STATIC_METHOD_TYPES = [
      \Omnipay\Omnipay::create('') => [
        'Braintree' instanceof \Omnipay\Braintree\Gateway,
      ],
      \Omnipay\Common\GatewayFactory::create('') => [
        'Braintree' instanceof \Omnipay\Braintree\Gateway,
      ],
    ];
}
