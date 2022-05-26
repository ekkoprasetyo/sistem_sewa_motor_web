<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;

class Encryptor {

    public static function path($string) {
        return Crypt::encryptString($string);
    }
}
