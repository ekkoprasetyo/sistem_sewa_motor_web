<?php

namespace App\Helpers;

final class ChCryptoHelper {
    static private function checkCryptKey($secretKey){
        if(strlen($secretKey) != 32) throw new Exception('"SecretKey length is not 32 chars"');
        $iv = substr($secretKey, 0, 16);
        return [$secretKey, $iv];
    }
    static function encrypt($v){
        $k = self::checkCryptKey(env('CHCRYPTO_KEY'));
        return openssl_encrypt($v, 'aes-256-cbc', $k[0], 0, $k[1]);
    }
    static function decrypt($v){
        $k = self::checkCryptKey(env('CHCRYPTO_KEY'));
        return openssl_decrypt($v, 'aes-256-cbc', $k[0], 0, $k[1]);
    }
}
