<?php

namespace app\Controller;

class MyCript {

    const KEY = '.key';

    // _________________________________________

    public static function getCurrentUrl() {
        $currentUrl =  strtolower(strstr($_SERVER['SERVER_PROTOCOL'], '/', 1));
        $currentUrl .= '://' .  $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
        $currentUrl = str_replace('/Views', '', $currentUrl);
        return $currentUrl;
    }

    // _________________________________________

    public static function generateKey() {
        $key = sodium_crypto_secretbox_keygen();
        return sodium_bin2hex( $key );
    }

    // _________________________________________

    public static function encrypt($secrete) {

        $key = sodium_hex2bin(file_get_contents(self::KEY));
        $nonce = random_bytes( SODIUM_CRYPTO_SECRETBOX_NONCEBYTES );
        $encrypted_result = sodium_crypto_secretbox( $secrete, $nonce, $key );
        $encoded = base64_encode( $nonce . $encrypted_result );
        return $encoded;
    }
    // _________________________________________

    public static function decrypt($encoded) {

        $key = sodium_hex2bin(file_get_contents(self::KEY));
        $decoded = base64_decode($encoded);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $encrypted_result = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
        return sodium_crypto_secretbox_open($encrypted_result, $nonce, $key);
    }

    // _________________________________________

    public static function passHash ($password) {
        $hash = sodium_crypto_pwhash_str(
            $password,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
        );

        return $hash;
    }

    // _________________________________________

    public static function passVerify ($hash, $password) {
        return sodium_crypto_pwhash_str_verify($hash, $password);
    }
}
?>