<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class UserProfile extends Request implements RequestInterface
{
    const URL = "/account/v1/user";

    private string $method = 'GET';

    public function getUrl(): string
    {
        return self::URL;
    }

    public function call(string $publicKey, string $secretKey, array $proxy = [])
    {
        return $this->dmarketHttpRequest($publicKey, $secretKey, [], $proxy);
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