# Omnipay: IngWebPay

**IngWebPay driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/thephpleague/omnipay-IngWebPay.png?branch=master)](https://travis-ci.org/thephpleague/omnipay-IngWebPay)
[![Latest Stable Version](https://poser.pugx.org/omnipay/IngWebPay/version.png)](https://packagist.org/packages/omnipay/IngWebPay)
[![Total Downloads](https://poser.pugx.org/omnipay/IngWebPay/d/total.png)](https://packagist.org/packages/omnipay/IngWebPay)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements IngWebPay support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "spgwebdev/ingwebpay": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* IngWebPay


Purchase

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('IngWebPay');
$gateway->setUserName('your_username');
$gateway->setPassword('your_password');

$data = [
    'amount' => 50.011,
    'currency' => 946, // 946 for RON , 978 for EUR
    'orderNumber' => 42424242424242424242,
    'description' => 'Test ING WEBPAY',
    'returnUrl' => 'http://exemple.com/returnUrl',
    'language' => 'ro', // 'ro' or 'en'
    'email' => 'your_email@exemple.com',
]; 

$response = $payment->purchase($data)->send();

if (!$response->isSuccessful()) 
{   
    return $response->getMessage();   
}

if ($response->isRedirect()) 
{
   return $response->redirect();
}


return $response->response();

```

Pre Purchase

```php

$data = [
    'amount' => 50.011,
    'currency' => 946, // 946 for RON , 978 for EUR
    'orderNumber' => 42424242424242424242,
    'description' => 'Test ING WEBPAY',
    'returnUrl' => 'http://exemple.com/returnUrl',
    'language' => 'ro', // 'ro' or 'en'
    'email' => 'your_email@exemple.com',
]; 

$response = $payment->prePurchase($data)->send();

if (!$response->isSuccessful()) 
{   
    return $response->getMessage();   
}

if ($response->isRedirect()) 
{
   return $response->redirect();
}


return $response->response();

```


Status payment

```php

$data = [
    'orderId' => 42424242424242424242,
    'language' => 'ro',
    'extended' => false, // see extended status
];

$response = $payment->purchaseStatus($data)->send();

if ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response->response());
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

```

Deposit payment

```php

$data = [
    'orderId' => 42424242424242424242,
    'amount' => 0 // if "0" will be charged init amount
    'language' => 'ro',
];

$response = $payment->depositPurchase($data)->send();

if ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response->response());
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

```

Reverse payment

```php

$data = [
    'orderId' => 42424242424242424242,
    'language' => 'ro',
];

$response = $payment->reversePurchase($data)->send();

if ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response->response());
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}

```

## Test mode and developer mode
  Most gateways allow you to set up a sandbox or developer account which uses a different url
  and credentials. Some also allow you to do test transactions against the live site, which does
  not result in a live transaction.
  
  Gateways that implement only the developer account (most of them) call it testMode. Authorize.net,
  however, implements both and refers to this mode as developerMode.  
  
  When implementing with multiple gateways you should use a construct along the lines of the following:
```php
if ($is_developer_mode) {
    if (method_exists($gateway, 'setDeveloperMode')) {
        $gateway->setDeveloperMode(TRUE);
    } else {
        $gateway->setTestMode(TRUE);
    }
}
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

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/thephpleague/omnipay-ingwebpay/issues),
or better yet, fork the library and submit a pull request.
