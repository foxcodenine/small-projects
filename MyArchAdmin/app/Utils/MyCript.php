<?php

namespace app\Utils;

class MyCript {
    public static function getCurrentUrl() {
        $currentUrl =  strtolower(strstr($_SERVER['SERVER_PROTOCOL'], '/', 1));
        $currentUrl .= '://' .  $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
        $currentUrl = str_replace('/Views', '', $currentUrl);
        return $currentUrl;
    }

    public static function generateKey() {
        $key = sodium_crypto_secretbox_keygen();
        return sodium_bin2hex( $key );
    }

    public static function encrypt($secrete) {

        $key = sodium_hex2bin(file_get_contents('../.key'));
        $nonce = random_bytes( SODIUM_CRYPTO_SECRETBOX_NONCEBYTES );
        $encrypted_result = sodium_crypto_secretbox( $secrete, $nonce, $key );
        $encoded = base64_encode( $nonce . $encrypted_result );
        return $encoded;
    }

    public static function decrypt($encoded) {

        $key = sodium_hex2bin(file_get_contents('../.key'));
        $decoded = base64_decode($encoded);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $encrypted_result = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
        return sodium_crypto_secretbox_open($encrypted_result, $nonce, $key);
    }

}


?>