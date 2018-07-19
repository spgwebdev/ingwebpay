# Omnipay: IngWebPay

**IngWebPay driver for the Omnipay PHP payment processing library**


[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements IngWebPay support for Omnipay.

## Installation

IngWebPay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "seniorprogramming/omnipay-ingwebpay": "~1.0"
    }
}
```

Or  run the composer require command from console:

    $ composer require seniorprogramming/omnipay-ingwebpay

## Basic Usage IngWebPay

### Purchase

Make a purchase using IngWebPay gateway

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('IngWebPay');
$gateway->initialize([
'userName' => config('ingwebpay.username'),
'password' => config('ingwebpay.password'),
]);

$purchaseData = [
    'amount' => 12.00, //mandatory
    'orderNumber' => '0001', //mandatory
    'returnUrl' => 'https://localhost/purchase-successful', //mandatory
    'description' => 'Test purchase', //optional
    'currency' => 948, //optional (RON currency code - set by default), see docs for other values,
    'language' => 'ro', //optional (RON currency code - set by default), see docs for other values,
    'email' => 'test@test.dev', //optional
];

$transaction = $gateway->purchase($purchaseData);
$response = $transaction->send();

if ($response->isSuccessful()){
    echo "Purchase transaction was successful!\n";
}
```

### PrePurchase

Make a pre purchase transaction using IngWebPay gateway

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('IngWebPay');
$gateway->initialize([
'userName' => config('ingwebpay.username'),
'password' => config('ingwebpay.password'),
]);

$purchaseData = [
    'amount' => 12.00, //mandatory
    'orderNumber' => '0001', //mandatory
    'returnUrl' => 'https://localhost/purchase-successful', //mandatory
    'description' => 'Test purchase', //optional
    'currency' => 948, //optional (RON currency code - set by default), see docs for other values,
    'language' => 'ro', //optional (RON currency code - set by default), see docs for other values,
    'email' => 'test@test.dev', //optional
];

$transaction = $gateway->prePurchase($purchaseData);
$response = $transaction->send();

if ($response->isSuccessful()){
    echo "PrePurchase transaction was successful!\n";
}
```

### Order Status

Get purchase status using IngWebPay gateway.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('IngWebPay');
$gateway->initialize([
'userName' => config('ingwebpay.username'),
'password' => config('ingwebpay.password'),
]);

$statusData = [
    'orderId' => '0001', //mandatory
    'extended' => true, //optional, for a more detailed response
    'language' => 'ro', //optional (RON currency code - set by default), see docs for other values,
];

$status = $status->purchaseStatus($statusData);
$response = $status->send();

print_r($response->response());
```

### Reverse PrePurchase

Reverse a pre purchase transaction using IngWebPay gateway

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('IngWebPay');
$gateway->initialize([
'userName' => config('ingwebpay.username'),
'password' => config('ingwebpay.password'),
]);

$purchaseData = [
    'orderId' => '0001', //mandatory
];

$transaction = $gateway->reversePurchase($purchaseData);
$response = $transaction->send();

if ($response->isSuccessful()){
    echo "Reverse pre purchase transaction was successful!\n";
}
```

### Complete PrePurchase

Complete a pre purchase transaction using IngWebPay gateway. Within 7 days for Maestro transactions and 14 days for VISA/Mastercard. After this time the pre-authorization expires and a new transaction request must be made by the client.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('IngWebPay');
$gateway->initialize([
'userName' => config('ingwebpay.username'),
'password' => config('ingwebpay.password'),
]);

$purchaseData = [
    'orderId' => '0001', //mandatory
    'amount' => 12.00, //mandatory, if the amount equals 0, the transaction uses the initial amount from prepurchase, Keep in mind that the amount requested cannot be bigger than the initial amount made through prePurchase. 
    'language' => 'ro', //optional (RON currency code - set by default), see docs for other values,
];

$transaction = $gateway->reversePurchase($purchaseData);
$response = $transaction->send();

if ($response->isSuccessful()){
    echo "Reverse pre purchase transaction was successful!\n";
}
```

