<?php
// require_once('../init.php'); // CHARGE MANUALLY ALL CLASS LIB

require '../vendor/autoload.php'; // AUTOLOAD FROM COMPOSER

$base_url="http://cmi-php.local/example";
$client = new Mehdirochdi\CMI\CmiClient([
    'storekey' => 'TEST1234', // STOREKEY
    'clientid' => '600002599', // CLIENTID
    'oid' => '137ABC', // COMMAND ID IT MUST BE UNIQUE
    'shopurl' => $base_url, // SHOP URL FOR REDIRECTION
    'okUrl' => $base_url.'/okFail.php', // REDIRECTION AFTER SUCCEFFUL PAYMENT
    'failUrl' => $base_url.'/okFail.php', // REDIRECTION AFTER FAILED PAYMENT
    'email' => 'mehdi.rochdi@gmail.com', // YOUR EMAIL APPEAR IN CMI PLATEFORM
    'BillToName' => 'mehdi rochdi', // YOUR NAME APPEAR IN CMI PLATEFORM
    'BillToCompany' => 'company name', // YOUR COMPANY NAME APPEAR IN CMI PLATEFORM
    'BillToStreet12' => '100 rue adress', // YOUR ADDRESS APPEAR IN CMI PLATEFORM NOT REQUIRED
    'BillToCity' => 'casablanca', // YOUR CITY APPEAR IN CMI PLATEFORM NOT REQUIRED
    'BillToStateProv' => 'Maarif Casablanca', // YOUR STATE APPEAR IN CMI PLATEFORM NOT REQUIRED
    'BillToPostalCode' => '20230', // YOUR POSTAL CODE APPEAR IN CMI PLATEFORM NOT REQUIRED
    'BillToCountry' => '504', // YOUR COUNTRY APPEAR IN CMI PLATEFORM NOT REQUIRED (504=MA)
    'tel' => '0021201020304', // YOUR PHONE APPEAR IN CMI PLATEFORM NOT REQUIRED
    'amount' => $_POST['amount'], // RETRIEVE AMOUNT WITH METHOD POST
    'CallbackURL' => $base_url.'/callback.php', // CALLBACK
]);

// OPTIONAL ATTRIBUTES
$client->lang = 'ar'; // CHANGE LANG PAGE
// $client->AutoRedirect = 'true'; // REDIRECT THE CUSTOMER AUTOMATICALY BACK TO THE MERCHANT's WEB SITE WHEN TRANSACION IS ACCEPTED

$client->redirect_post(); // CREATE INPUTS HIDDEN, GENERATE A VALID HASH AND MAKE REDIRECT POST TO CMI
?>