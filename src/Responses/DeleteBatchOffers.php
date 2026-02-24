<?php

namespace DMarketAuthApi\Responses;

use DMarketAuthApi\Interfaces\ResponseInterface;

class DeleteBatchOffers implements ResponseInterface
{
    private $data;
    private $detailed;

    public function __construct($response, bool $detailed = false)
    {
        $this->detailed = $detailed;
        $this->data = $this->decodeResponse($response);
    }

    public function response()
    {
        return $this->data;
    }

    private function decodeResponse($response)
    {
        $returnData = $response;

        if ($this->detailed) {
            $data = json_decode($returnData['response'], true);

            if (!$data)
                $returnData['response'] = false;
            else
                $returnData['response'] = $data;

            return $returnData;
        } else {
            $data = json_decode($returnData, true);

            if (!$data)
                return false;

            return $data;
        }
    }
}