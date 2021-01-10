<?php

namespace DMarketAuthApi\Interfaces;

interface ResponseInterface
{
    public function __construct($response);

    public function response();
}