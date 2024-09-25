# Omnipay: Converse

**Converse driver for the Omnipay Laravel payment processing library**


[Omnipay](https://github.com/thephpleague/omnipay) is a framework-agnostic, multi-gateway payment
processing library for PHP 5.5+. This package implements Converse support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "ucraft-com/omnipay-converse": "^1.0"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require ucraft-com/omnipay-converse

## Basic Usage

1. Initialize Converse gateway:

```php

    use Omnipay\Omnipay;
    use Omnipay\Converse\ConverseGateway;

    $gateway = Omnipay::create(ConverseGateway::class);
    $gateway->setMerchantId('123'); // Merchant ID, provided by ConverseBank
    $gateway->setMerchantToken('*******************************'); // Merchant password, provided by ConverseBank

```

3. Call purchase, it will automatically redirect to ConverseBank's hosted page

```php

     $response = $gateway->purchase([
            'amount'        => '10',
            'returnUrl'    => 'http:\/\/cportal.im\/hy\/test?back=1&order_number=1',
            'language'     => 'en',
            'currency'     => 'EUR',
            'orderNumber'  => '000866',
     ])->send();

     redirect($response->getRedirectUrl());

```

4. Create a controller to handle the callback request. This URL merchant should provide ConverseBank during registration.

```php
    
    $fetchTransactionResponse = $gateway->fetchTransaction([
                'transactionId' => 'some-transaction-id',
    ])->send();
    
    if ($fetchTransactionResponse->isSuccessful()) {
        // Your logic is to mark the order as paid.
    }

```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/ucraft-com/omnipay-converse/issues),
or better yet, fork the library and submit a pull request.
