# CMI PHP Payment bindings

CMI PHP PAYMENT is an open source **PHP payment handling** library. it provides an easier way to communicate with CMI PAYMENT PLATEFORM **[cmi.co.ma](https://www.cmi.co.ma/fr/solutions-paiement-carte-paiement-ligne/ecommerce)** in morocco.

The class is written OOP to make easier to communicate and understand how CMI work.

NB: The small library follows the FIG standard **PSR-4** .

## System Requirements

cmi-php requires the following components to work correctly

- PHP>=5.4
- [cUrl](https://www.php.net/manual/en/book.curl.php) Extension
- [mbstring](https://www.php.net/manual/en/book.mbstring.php) Extension


## Composer Installation

You can install the bindings via [composer](https://getcomposer.org/). Run the following command:
```shell
composer require mehdirochdi/cmi-payment-php
```
To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading)
```shell
require_once('vendor/autoload.php');
```
## Manual Installation

If you do not wish to use Composer for some reason, you can usethe bindings, include the init.php file.
```shell
require_once('/path/to/cmi-php/init.php');
```

## Getting Started

Example amount text fields `example/formRequest.php`:

```php title="example/formRequest.php"
...
    <h1>Payment form CMI</h1>
    <form method="post" action="/example/process.php">
    <label for="amount">Amount</label>
        <input type="text" name="amount" class="input-control" placeholder="put amount here 10.65" value="10.60"> DHS<br/>
        <button type="submit">Buy</button>
    </form>
...
```
Keeping mind that `storekey` and `clientid` are given by CMI, you should contact them **[cmi.co.ma](https://www.cmi.co.ma/fr/solutions-paiement-carte-paiement-ligne/ecommerce)**

```php title="example/process.php"
<?php
// REQUIRED PARAMS
$client = new Mehdirochdi\CMI\CmiClient([
    'storekey' => '', // STOREKEY
    'clientid' => '', // CLIENTID
    'oid' => '135ABC', // COMMAND ID IT MUST BE UNIQUE
    'shopurl' => 'YOUR_DOMAIN_HERE', // SHOP URL FOR REDIRECTION
    'okUrl' => 'YOUR_DOMAIN_HERE/okFail.php', // REDIRECTION AFTER SUCCEFFUL PAYMENT
    'failUrl' => 'YOUR_DOMAIN_HERE/okFail.php', // REDIRECTION AFTER FAILED PAYMENT
    'email' => 'mehdi.rochdi@gmail.com', // YOUR EMAIL APPEAR IN CMI PLATEFORM
    'BillToName' => 'mehdi rochdi', // YOUR NAME APPEAR IN CMI PLATEFORM
    'BillToCompany' => 'company name', // YOUR COMPANY NAME APPEAR IN CMI PLATEFORM
    'amount' => $_POST['amount'], // RETRIEVE AMOUNT WITH METHOD POST
    'CallbackURL' => 'YOUR_DOMAIN_HERE/callback.php', // CALLBACK
]);

$client->redirect_post(); // CREATE INPUTS HIDDEN, GENERATE A VALID HASH AND MAKE REDIRECT POST TO CMI
?>
```
![Payment page](https://intdesigners.com/payment-page.png)


## Basic test card numbers
Credit Card information cannot be used in test mode. instead, use any of the following test card numbers, a valid expiration date in the future, and any random CVC number, to create a successful payment.

Branch : `visa`, PAN: `4000000000000010`, Expired date: `make any date` CVC: `000`

Branch : `MasterCard`, PAN: `5453010000066100`, Expired date: `make any date` CVC: `000`

## 3D Secure test card numbers
The following card information try to tests local payments such as Strong Customer Authentication **SCA**

Branch : `MasterCard`, PAN: `5191630100004896`, Authentication code: `123` Expired date: `make any date` CVC: `000`

![Payment page](https://intdesigners.com/3dsecure.png)

## Optional Params Example
```php title="example/process.php"
<?php
// REQUIRED PARAMS
$client = new Mehdirochdi\CMI\CmiClient([
    ...
]);

$client->AutoRedirect = 'true'; // REDIRECT THE CUSTOMER AUTOMATICALY BACK TO THE MERCHANT's WEB SITE WHEN TRANSACION IS ACCEPTED
$client->redirect_post(); // CREATE INPUTS HIDDEN, GENERATE A VALID HASH AND MAKE REDIRECT POST TO CMI
```
