<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use CMI\CmiClient;
use CMI\Exception\InvalidArgumentException;

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
}
