<?php

namespace App\Http\Api;

use Illuminate\Support\Facades\Http;

class Api {

    private const SPOT_BASE_URL = 'https://api.kucoin.com';
    private const FUTURES_BASE_URL = 'https://api-futures.kucoin.com';
    private const API_VERSION = '2';

    public function call($uri, $method) {
        $response = Http::withHeaders([
            'KC-API-KEY' => $this->getKey(),
            'KC-API-SIGN' => $this->signature($uri, '', $this->getTimestampInMilliseconds(), $method),
            'KC-API-TIMESTAMP' => $this->getTimestampInMilliseconds(),
            'KC-API-PASSPHRASE' => $this->getPassphrase(),
            'KC-API-KEY-VERSION' => SELF::API_VERSION,
            ])->get(SELF::FUTURES_BASE_URL . $uri);
        
        return $response;
    }
}