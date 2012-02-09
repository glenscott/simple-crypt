<?php

require_once 'PHPUnit/Framework/TestCase.php';
require_once 'SimpleCrypt.php';

class SimpleCryptTest extends PHPUnit_Framework_TestCase {
    protected $simplecrypt;
    private   $original_string;

    protected function setUp() {
        $this->original_string = 'very important data';
        $this->simplecrypt = new SimpleCrypt( 'tripledes', 'mysecretkey' );
    }

    public function testObjectInstantiation() {
        $this->assertTrue( is_a( $this->simplecrypt, 'SimpleCrypt' ) );
    }

    public function testEncryptedStringIsIdentitalAfterDecryption() {
        $enc = $this->simplecrypt->encrypt_data( $this->original_string );
        $this->assertTrue( is_string( $enc ) );

        $dec = $this->simplecrypt->decrypt_data( $enc );
        $this->assertTrue( is_string( $dec ) );
        $this->assertTrue( strncmp( $dec, $this->original_string, strlen($this->original_string)) == 0 );
    }
}
