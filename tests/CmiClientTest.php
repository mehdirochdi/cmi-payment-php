<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Mehdirochdi\CMI\CmiClient;
use Mehdirochdi\CMI\Exception\InvalidArgumentException;

final class CmiClientTest extends TestCase
{
    public function test_it_require_storekey()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('storekey is required');

        new CmiClient();
    }

    public function test_storekey_null()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('storekey is required');

        new CmiClient(['storekey' => null]);
    }

    public function test_storekey_has_space()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('storekey cannot contain whitespace');

        new CmiClient(['storekey' => '123 256']);
    }

    public function test_if_hash_is_validated()
    {
        $base_url="http://cmi-php.local/example";
        $client = new Mehdirochdi\CMI\CmiClient([
            'storekey' => '987456', // STOREKEY
            'clientid' => '1234567', // CLIENTID
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
            'amount' => '10.60', // RETRIEVE AMOUNT WITH METHOD POST
            'CallbackURL' => $base_url.'/callback.php', // CALLBACK
        ]);
        $client->generateHash();
        $this->assertNotNull($client->Hash);
    }
}
