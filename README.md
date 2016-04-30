# Verify IPN with PayPal.

Require the package

```
$ composer require paypal-ipn
```

Minimal code to use the verifier

```php
<?php

require __DIR__.'/vendor/autoload.php';

$ipn = $_POST;

if (\PayPal\Ipn\verifyIpn($ipn)) {
    // verified
} else {
    // not verified
}
```

There is also a `verifyIpnSandbox($ipn)` method, which can be useful for testing with the PayPal sandbox mode.

The method uses `GuzzleHttp\Client` to communicate with the PayPal server by default. If you want you can pass an alternative Client as a third parameter. It must implement `PayPal\Ipn\HttpClient`, which makes a POST request to a given URL with the form_params set to the IPN, and returns a PSR7 compliant ResponseInterface.