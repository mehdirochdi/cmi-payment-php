<?php
require_once('../init.php');

$client = new CMI\CmiClient([
    'storekey' => '', //
    'clientid' => '', // CLIENTID
    'oid' => '135ABC', // COMMAND ID IT MUST BE UNIQUE
    'shopurl' => 'http://cmiphp.local',
    'okUrl' => 'http://cmiphp.local/okFail.php',
    'failUrl' => 'http://cmiphp.local/okFail.php',
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
    'CallbackResponse' => 'true',
    'CallbackURL' => 'http://cmiphp.local/callback.php',
]);
$client->redirect_post();

// 4000000000000010
?>