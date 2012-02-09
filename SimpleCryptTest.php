<?php

require_once 'PHPUnit/Framework/TestCase.php';
require_once 'SimpleCrypt.php';

class SimpleCryptTest extends PHPUnit_Framework_TestCase {
    protected $simplecrypt;

    protected function setUp() {
        $this->simplecrypt = new SimpleCrypt( 'tripledes', 'key', 'string' );
    }

    public function testObjectInstantiation() {
        $this->assertTrue( is_a( $this->simplecrypt, 'SimpleCrypt' ) );
    }

    public function testEncryptedStringIsIdentitalAfterDecryption() {
        $this->markTestIncomplete(
                                  'This test has not been completed yet.'
                                  );
        $this->assertEquals( 'string', $this->simplecrypt->decrypt_data( $this->simplecrypt->encrypt_data() ) );
    }
}
