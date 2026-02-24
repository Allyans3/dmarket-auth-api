<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class UpdateBatchOffers extends Request implements RequestInterface
{
    const URL = "/marketplace-api/v2/offers:batchUpdate";

    private string $method = 'PATCH';

    public function getUrl(): string
    {
        return self::URL;
    }

    /**
     * @throws \SodiumException
     */
    public function call(string $publicKey, string $secretKey, array $postParams = [], bool $detailed = false, array $proxy = [])
    {
        return $this->dmarketHttpRequest($publicKey, $secretKey, $postParams, $detailed, $proxy);
    }

    public function getRequestMethod(): string
    {
        return $this->method;
    }

    public function getRootUrl(): string
    {
        return "https://api.dmarket.com";
    }
}