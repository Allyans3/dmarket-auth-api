<?php

namespace DMarketAuthApi\Responses;

use DMarketAuthApi\Interfaces\ResponseInterface;

class WithdrawAssets implements ResponseInterface
{
    private $data;

    public function __construct($response)
    {
        $this->data = $this->decodeResponse($response);
    }

    public function response()
    {
        return $this->data;
    }

    private function decodeResponse($response)
    {
        return json_decode($response, true);
    }
}