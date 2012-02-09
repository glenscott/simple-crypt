<?php

/**
 * OO library for mcrypt functionality
 *
 * @author Glen Scott <glen@glenscott.co.uk>
 */
class SimpleCrypt {
    /**
     * @var string
     */
    private $key;
    
    /**
     * @var string
     */
    private $input;

    /*
     * @var string
     */
    private $algorithm;

    /*
     * @var resource
     */
    private $td;

    /*
     * @var string
     */
    private $iv;


    public function __construct( $algorithm, $key, $input ) {
        $this->algorithm = $algorithm;
        $this->key       = $key;
        $this->input     = $input;

        $this->open_module();
        $this->create_init_vector();
    }

    public function __destruct() {
        mcrypt_module_close( $this->td );
    }

    private function open_module() {
        $this->td = mcrypt_module_open( $this->algorithm, null, 'cbc', null );
    }

    private function create_init_vector() {
        $this->iv = mcrypt_create_iv( mcrypt_enc_get_iv_size( $this->td ), MCRYPT_RAND );
    }

    private function generic_init() {
        return mcrypt_generic_init( $this->td, $this->key, $this->iv );
    }

    public function encrypt_data() {
        $this->generic_init();
        $enc = mcrypt_generic( $this->td, $this->input );
        mcrypt_generic_deinit( $this->td );

        return $enc;
    }

    /**
     * @param $enc string
     */
    public function decrypt_data( $enc ) {
        $this->generic_init();
        $dec = mdecrypt_generic( $this->td, $enc );
        mcrypt_generic_deinit( $this->td );

        return $dec;
    }

    static public function get_available_algorithms() {
        return mcrypt_list_algorithms();
    }
}
