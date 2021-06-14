<?php
require_once('./lib/Exception/ExceptionInterface.php');
require_once('./lib/Exception/InvalidArgumentException.php');
require_once('./lib/CmiClientInterface.php');
require_once('./lib/BaseCmiClient.php');
require_once('./lib/CmiClient.php');

$_POST['storekey'] = 'TEST1234';
$hash = $_POST['HASH'];

$client = new CMI\CmiClient($_POST);

$status = $client->hash_eq($_POST['HASH']);
if($status) {
	echo 'echo HASH is successfull, so the transaction went well';
}else {
	echo 'It mean the hash generated not equal to hash sended by CMI plateform ';
}
?>