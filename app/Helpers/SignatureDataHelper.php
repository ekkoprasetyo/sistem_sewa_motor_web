<?php

namespace App\Helpers;

class SignatureDataHelper {

    public static function create($document, $document_number, $sign_by, $sign_position, $sign_on) {
        $signature['issuer'] = 'PT. RAILINK - KAI BANDARA';
        $signature['document'] = $document;
        $signature['document_number'] = $document_number;
        $signature['signer'] = $sign_by;
        $signature['signer_position'] = $sign_position;
        $signature['sign_on'] = $sign_on;

        $signature_json = json_encode($signature);

        return ChCryptoHelper::encrypt($signature_json);
    }
}
