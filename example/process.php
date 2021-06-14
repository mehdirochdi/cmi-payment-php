<?php
// require_once('../init.php'); // CHARGE MANUALLY ALL CLASS LIB

require '../vendor/autoload.php'; // AUTOLOAD FROM COMPOSER

$client = new CMI\CmiClient([
    'storekey' => '', // STOREKEY
    'clientid' => '', // CLIENTID
    'oid' => '135ABC', // COMMAND ID IT MUST BE UNIQUE
    'shopurl' => 'YOUR_DOMAIN_HERE',
    'okUrl' => 'YOUR_DOMAIN_HERE/okFail.php',
    'failUrl' => 'YOUR_DOMAIN_HERE/okFail.php',
    'email' => 'mehdi.rochdi@gmail.com',
    'BillToName' => 'mehdi rochdi',
    'BillToCompany' => 'company name',
    'BillToStreet12' => '100 rue adress',
    'BillToCity' => 'casablanca',
    'BillToStateProv' => 'Maarif Casablanca',
    'BillToPostalCode' => '20230',
    'BillToCountry' => '504',
    'tel' => '0021201020304',
    'amount' => $_POST['amount'], // must be handled and securised
    'CallbackURL' => 'YOUR_DOMAIN_HERE/callback.php',
]);

// OPTIONAL ATTRIBUTES
// $client->AutoRedirect = 'true'; // REDIRECT THE CUSTOMER AUTOMATICALY BACK TO THE MERCHANT's WEB SITE WHEN TRANSACION IS ACCEPTED

$client->redirect_post();
?>