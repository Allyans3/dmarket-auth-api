<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class DepositStatus extends Request implements RequestInterface
{
    const URL = "/marketplace-api/v1/deposit-status/";

    private string $depositId;
    private string $method = 'GET';

    public function __construct($depositId)
    {
        $this->depositId = $depositId;
    }

    public function getUrl(): string
    {
        return self::URL . $this->depositId;
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