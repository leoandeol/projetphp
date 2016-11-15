<?php

class Security {

    private static $seed = 'CUyz9DnfimN2G7qabc1Y';

    public static function encrypt($s) {
        $s = $s . self::$seed;
        $tmp = hash('sha512', $s);
        return $tmp;
    }

    function generateRandomHex() {
        // Generate a 32 digits hexadecimal number
        $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
        $bytes = openssl_random_pseudo_bytes($numbytes);
        $hex = bin2hex($bytes);
        return $hex;
    }

}
