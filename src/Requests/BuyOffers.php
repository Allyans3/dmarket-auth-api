<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class BuyOffers extends Request implements RequestInterface
{
    const URL = "/exchange/v1/offers-buy";

    private string $method = 'PATCH';

    public function getUrl(): string
    {
        return self::URL;
    }

    /**
     * @throws \SodiumException
     */
    public function call(string $publicKey, string $secretKey, array $postParams = [], array $proxy = [])
    {
        return $this->dmarketHttpRequest($publicKey, $secretKey, $postParams, $proxy);
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