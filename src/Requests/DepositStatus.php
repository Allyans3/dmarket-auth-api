<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class DepositStatus extends Request implements RequestInterface
{
    const URL = "/marketplace-api/v1/deposit-status/%s";

    private string $depositId;
    private string $method = 'GET';

    public function __construct($depositId)
    {
        $this->depositId = $depositId;
    }

    public function getUrl(): string
    {
        return sprintf(self::URL, $this->depositId);
    }

    /**
     * @throws \SodiumException
     */
    public function call(string $publicKey, string $secretKey, bool $detailed = false, array $proxy = [])
    {
        return $this->dmarketHttpRequest($publicKey, $secretKey, [], $detailed, $proxy);
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