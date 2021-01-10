<?php

namespace DMarketAuthApi\Interfaces;

interface RequestInterface
{
    public function getUrl();

    public function call(string $publicKey, string $secretKey);

    public function getRequestMethod();

    public function getRootUrl();
}