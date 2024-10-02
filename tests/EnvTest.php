<?php

namespace Tests;

use Lithe\Support\Env;
use PHPUnit\Framework\TestCase;

class EnvTest extends TestCase
{
    protected function setUp(): void
    {
        // Set up a temporary .env file for testing
        file_put_contents(__DIR__ . '/.env', "DB_HOST=localhost\nDB_USER=root\nDB_PASS=secret");
        Env::load(__DIR__);
    }

    protected function tearDown(): void
    {
        // Remove the temporary .env file after tests
        unlink(__DIR__ . '/.env');
    }

    public function testLoad()
    {
        $this->assertEquals('localhost', Env::get('DB_HOST'));
        $this->assertEquals('root', Env::get('DB_USER'));
        $this->assertEquals('secret', Env::get('DB_PASS'));
    }

    public function testGetWithDefaultValue()
    {
        $this->assertEquals('default_value', Env::get('NON_EXISTENT_KEY', 'default_value'));
    }

    public function testSetAndGet()
    {
        Env::set('NEW_KEY', 'new_value');
        $this->assertEquals('new_value', Env::get('NEW_KEY'));
    }

    public function testHas()
    {
        $this->assertTrue(Env::has('DB_HOST'));
        $this->assertFalse(Env::has('NON_EXISTENT_KEY'));
        $this->assertTrue(Env::has(['DB_USER', 'DB_HOST'])); // Testing with array
        $this->assertFalse(Env::has(['NON_EXISTENT_KEY', 'DB_HOST'])); // Testing with array
    }
}
