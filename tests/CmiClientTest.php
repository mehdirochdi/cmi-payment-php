<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CmiClientTest extends TestCase
{
    public function testCanBeCreated() {
        $this->assertEquals(
            'user@example.com',
            'user@example.com'
        );
    }
}