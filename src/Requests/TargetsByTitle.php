<?php

namespace DMarketAuthApi\Requests;

use DMarketAuthApi\Engine\Request;
use DMarketAuthApi\Interfaces\RequestInterface;

class TargetsByTitle extends Request implements RequestInterface
{
    const URL = "/marketplace-api/v1/targets-by-title/%s/%s";

    private string $gameId;
    private string $title;
    private string $method = 'GET';

    public function __construct($gameId, $title)
    {
        $this->gameId = $gameId;
        $this->title = $title;
    }

    public function getUrl(): string
    {
        return sprintf(self::URL, $this->gameId, $this->title);
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