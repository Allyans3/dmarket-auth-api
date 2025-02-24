<?php

namespace DMarketAuthApi\Engine;

use Carbon\Carbon;
use RuntimeException;
use DMarketAuthApi\Configs\Engine;

abstract class Request
{
    const RESPONSE_PREFIX = '\\DMarketAuthApi\\Responses\\';

    private $curl;
    private $curlOpts = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false
    ];

    public function initCurl()
    {
        $this->curl = curl_init();
    }

    /**
     * @throws \SodiumException
     */
    public function dmarketHttpRequest($publicKey, $secretKey, $postParams = [], bool $detailed = false, array $proxy = [])
    {
        if (!isset($this->curl))
            $this->initCurl();

        $postFields = [];

        if ($postParams)
            $postFields = [
                CURLOPT_POSTFIELDS => json_encode($postParams)
            ];

        curl_setopt_array($this->curl, $this->curlOpts + $proxy + [
                CURLOPT_CUSTOMREQUEST => $this->getRequestMethod(),
                CURLOPT_URL => $this->getRootUrl() . $this->getUrl(),
                CURLOPT_HTTPHEADER => [
                    'X-Api-Key: ' . $publicKey,
                    'X-Request-Sign: ' . $this->generateSignature($secretKey, $this->getRequestMethod(), $this->getUrl(), Carbon::now()->timestamp, $postParams),
                    'X-Sign-Date: ' . Carbon::now()->timestamp,
                    'Content-Type: ' . 'application/json'
                ],
                CURLOPT_HEADER => $detailed,
            ] + $postFields
        );

        return $this->response($detailed ? self::exec() : curl_exec($this->curl), $detailed);
    }

    /**
     * @return array
     */
    public function exec(): array
    {
        $response = curl_exec($this->curl);

        $requestHeaders = curl_getinfo($this->curl,CURLINFO_HEADER_OUT);
        $headerSize = curl_getinfo($this->curl,CURLINFO_HEADER_SIZE);
        $responseHeader = substr($response, 0, $headerSize);

        $code = curl_getinfo($this->curl,CURLINFO_HTTP_CODE) ?: '';
        $messageCode = array_key_exists($code, Engine::HTTP_CODES) ? Engine::HTTP_CODES[$code] : '';

        return [
            'request_headers' => self::headersToArray($requestHeaders),
            'response_headers' => self::headersToArray($responseHeader),
            'url' => curl_getinfo($this->curl,CURLINFO_EFFECTIVE_URL),
            'code' => $code,
            'message' => $messageCode,
            'error' => curl_error($this->curl),
            'cookies' => self::getCookie($response),
            'remote_ip' => curl_getinfo($this->curl,CURLINFO_PRIMARY_IP),
            'local_ip' => curl_getinfo($this->curl,CURLINFO_LOCAL_IP),
            'total_time' => bcdiv(curl_getinfo($this->curl,CURLINFO_TOTAL_TIME_T), 1000),
            'response' => substr($response, $headerSize)
        ];
    }

    /**
     * @param string $header
     * @return array
     */
    private function headersToArray(string $header): array
    {
        $headers = [];
        $headersTmpArray = explode("\r\n", $header);

        for ($i = 0 ; $i < count( $headersTmpArray ) ; ++$i) {
            // we don't care about the two \r\n lines at the end of the headers
            if (strlen( $headersTmpArray[$i] ) > 0) {

                // the headers start with HTTP status codes, which do not contain a colon, so we can filter them out too
                if (strpos( $headersTmpArray[$i] , ":")) {
                    $headerName = substr( $headersTmpArray[$i] , 0 , strpos( $headersTmpArray[$i] , ":" ) );
                    $headerValue = substr( $headersTmpArray[$i] , strpos( $headersTmpArray[$i] , ":" )+1 );
                    $headers[$headerName] = trim($headerValue);
                }
            }
        }

        return $headers;
    }

    /**
     * @param $response
     * @return array
     */
    private function getCookie($response): array
    {
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi',
            $response, $match_found);

        $cookies = [];

        foreach ($match_found[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }

        return $cookies;
    }

    public function response($data, bool $detailed = false)
    {
        curl_close($this->curl);

        $class = self::RESPONSE_PREFIX . strrev(explode('\\', strrev(get_called_class()), 2)[0]);

        if (!class_exists($class)) {
            throw new RuntimeException('Call to undefined response type');
        }

        return new $class($data, $detailed);
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