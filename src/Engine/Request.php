<?php

namespace DMarketAuthApi\Engine;

use Carbon\Carbon;
use RuntimeException;

abstract class Request
{
    const RESPONSE_PREFIX = '\\DMarketAuthApi\\Responses\\';

    private $ch;
    private $curlOpts = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false
    ];

    public function initCurl()
    {
        $this->ch = curl_init();
    }

    /**
     * @throws \SodiumException
     */
    public function dmarketHttpRequest($publicKey, $secretKey, $postParams = [], $proxy = [])
    {
        if (!isset($this->ch)) {
            $this->initCurl();
        }

        $postFields = [];

        if (!empty($postParams))
            $postFields = [
                CURLOPT_POSTFIELDS => json_encode($postParams)
            ];

        curl_setopt_array($this->ch, $this->curlOpts + $proxy + [
                CURLOPT_CUSTOMREQUEST => $this->getRequestMethod(),
                CURLOPT_URL => $this->getRootUrl() . $this->getUrl(),
                CURLOPT_HTTPHEADER => [
                    'X-Api-Key: ' . $publicKey,
                    'X-Request-Sign: ' . $this->generateSignature($secretKey, $this->getRequestMethod(), $this->getUrl(), Carbon::now()->timestamp, $postParams),
                    'X-Sign-Date: ' . Carbon::now()->timestamp,
                    'Content-Type: ' . 'application/json'
                ],
            ] + $postFields
        );

        return $this->response(curl_exec($this->ch));
    }

    public function response($data)
    {
        curl_close($this->ch);

        $class = self::RESPONSE_PREFIX . strrev(explode('\\', strrev(get_called_class()), 2)[0]);

        if (!class_exists($class)) {
            throw new RuntimeException('Call to undefined response type');
        }

        return new $class($data);
    }

    /**
     * @throws \SodiumException
     */
    private function generateSignature($privateKey, $method, $route, $timestamp, array $postParams = []): string
    {
        if (!empty($postParams))
            $text = $method . $route . json_encode($postParams) . $timestamp;
        else
            $text = $method . $route . $timestamp;

        return 'dmar ed25519 ' . sodium_bin2hex(sodium_crypto_sign_detached($text, sodium_hex2bin($privateKey)));
    }
}