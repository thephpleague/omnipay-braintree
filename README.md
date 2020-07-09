# Omnipay: Braintree

**Braintree driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/thephpleague/omnipay-braintree.svg?branch=master)](https://travis-ci.org/thephpleague/omnipay-braintree)
[![Latest Stable Version](https://poser.pugx.org/omnipay/braintree/version.png)](https://packagist.org/packages/omnipay/braintree)
[![Total Downloads](https://poser.pugx.org/omnipay/braintree/d/total.png)](https://packagist.org/packages/omnipay/braintree)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 7.2+. This package implements Braintree support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```
composer require omnipay/braintree:"~4.0@dev"
```

## Basic Usage

The following gateways are provided by this package:

* Braintree

You need to set your `merchantId`, `publicKey` and `privateKey`. Setting `testMode` to true will use the `sandbox` environment.

This gateway supports purchase through a token (payment nonce) only. You can generate a clientToken for Javascript:

```php
$clientToken = $gateway->clientToken()->send()->getToken();
```
The generated token will come in handy when using the Javascript SDK to display the [Drop-in Payment UI](https://developers.braintreepayments.com/guides/drop-in/javascript/v2) or [hosted fields](https://developers.braintreepayments.com/guides/hosted-fields/setup-and-integration/javascript/v2) used to collect payment method information.

On successful submission of the payment form, a one-time-use token that references a payment method provided by your customer, such as a credit card or PayPal account is dynamically added to the form as the value of a hidden `payment_method_nonce` input field.

Use the `payment_method_nonce` to process your customer order like so:


```php
$response = $gateway->purchase([
            'amount' => '10.00',
            'token' => $_POST['payment_method_nonce']
        ])->send();
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Driver specific usage
### Create customer

```php
$customer = $gateway->createCustomer([
    'customerData' => [
        'id' => 1,
        'firstName' => 'John',
        'lastName' => 'Doe'
    ]
])->send();
```
You can find full list of options [here](https://developers.braintreepayments.com/reference/request/customer/create/php).

### Find customer (By ID)

```php
$customer = $gateway->findCustomer(1)->send();
```
You can find full list of options [here](https://developers.braintreepayments.com/reference/request/customer/find/php)

### Create payment method

```php
$method = $gateway->createPaymentMethod([
    'customerId' => $user->getId(),
    'paymentMethodNonce' => 'paymentnonce',
    'options' => [
        'verifyCard' => true
    ]
]);
```
You can find full list of options [here](https://developers.braintreepayments.com/reference/request/payment-method/create/php).

### Update payment method

```php
$method = $gateway->updatePaymentMethod([
    'paymentMethodToken' => 'token123',
    'options' => [
        'paymentMethodNonce' => 'paymentnonce'
    ]
]);
```
You can find full list of options [here](https://developers.braintreepayments.com/reference/request/payment-method/update/php).

### Create subscription

```php
$subscription = $gateway->createSubscription([
    'subscriptionData' => [
        'paymentMethodToken' => 'payment_method_token',
        'planId' => 'weekly',
        'price' => '30.00'
    ]
])->send();
```
You can find full list of options [here](https://developers.braintreepayments.com/reference/request/subscription/create/php)

### Cancel subscription

```php
$subscription = $gateway->cancelSubscription('id')->send();
```
You can find full list of options [here](https://developers.braintreepayments.com/reference/request/subscription/cancel/php)

### Parse webhook notification

```php
$notification = $gateway->parseNotification([
    'bt_signature' => 'signature',
    'bt_payload' => 'payload'
])->send();
```
You can find full list of options [here](https://developers.braintreepayments.com/guides/webhooks/parse/php)

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/thephpleague/omnipay-braintreee/issues),
or better yet, fork the library and submit a pull request.
