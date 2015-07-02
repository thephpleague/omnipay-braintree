# Omnipay: Braintree

**Braintree driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/thephpleague/omnipay-braintreee.png?branch=master)](https://travis-ci.org/thephpleague/omnipay-braintreee)
[![Latest Stable Version](https://poser.pugx.org/omnipay/braintreee/version.png)](https://packagist.org/packages/omnipay/braintreee)
[![Total Downloads](https://poser.pugx.org/omnipay/braintreee/d/total.png)](https://packagist.org/packages/omnipay/braintreee)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Braintree support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```
composer require omnipay/braintree
```

## Basic Usage

The following gateways are provided by this package:

* Braintree

You need to set your `merchantId`, `publicKey` and `privateKey`. Setting `testMode` to true will use the `sandbox` environment.

This gateway supports purchase through a token (payment nonce) only. You can generate a clientToken for Javascript:

```php
$clientToken = $gateway->clientToken()->send()->getToken();
```

You can use the Braintree JavaScript client to generate the token for your CreditCard data.

```php
$response = $gateway->purchase([
            'amount' => '10.00',
            'token' => $_POST['payment_method_nonce']
        ])->send();
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/thephpleague/omnipay-braintreee/issues),
or better yet, fork the library and submit a pull request.
