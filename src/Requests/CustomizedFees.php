<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class CustomizedFees extends Request implements RequestInterface
{
    const URL = "/exchange/v1/customized-fees";

    private string $method = 'GET';
    private string $queryPath;

    public function __construct($queries)
    {
        $this->queryPath = http_build_query($queries);
    }

    public function getUrl(): string
    {
        return self::URL . (!empty($this->queryPath) ? '?' . $this->queryPath : '');
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