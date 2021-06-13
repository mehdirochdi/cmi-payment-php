<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use CMI\CmiClient;
use CMI\Exception\InvalidArgumentException;

final class CmiClientTest extends TestCase
{
    public function test_it_require_storekey() {

        try{
            $client = new CmiClient();
        }catch(InvalidArgumentException $e) {

            $this->assertEquals(
                'storekey is required',
                $e->getMessage()
            );
        }  
    }

    public function test_storekey_null() {

        try{
            $client = new CmiClient(['storekey' => null]);
        }catch(InvalidArgumentException $e) {
            //die($e->getMessage());
            $this->assertEquals(
                'storekey is required',
                $e->getMessage()
            );
        }  
    }

    public function test_storekey_has_space() {

        try{
            $client = new CmiClient(['storekey' => '123 256']);
        }catch(InvalidArgumentException $e) {
            //die($e->getMessage());
            $this->assertEquals(
                'storekey cannot contain whitespace',
                $e->getMessage()
            );
        }  
    }
}