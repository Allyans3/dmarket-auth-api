<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class SyncUserInventory extends Request implements RequestInterface
{
    const URL = "/marketplace-api/v1/user-inventory/sync";

    private string $method = 'POST';

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