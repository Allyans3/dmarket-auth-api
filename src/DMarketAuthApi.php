<?php

namespace DMarketAuthApi;

use DMarketAuthApi\Requests\AggregatedPrices;
use DMarketAuthApi\Requests\BuyOffers;
use DMarketAuthApi\Requests\ClosedUserTargets;
use DMarketAuthApi\Requests\CreateUserOffers;
use DMarketAuthApi\Requests\CreateUserTargets;
use DMarketAuthApi\Requests\DeleteOffers;
use DMarketAuthApi\Requests\DeleteUserTargets;
use DMarketAuthApi\Requests\DepositAssets;
use DMarketAuthApi\Requests\DepositStatus;
use DMarketAuthApi\Requests\EditUserOffers;
use DMarketAuthApi\Requests\MarketItems;
use DMarketAuthApi\Requests\OffersByTitle;
use DMarketAuthApi\Requests\SyncUserInventory;
use DMarketAuthApi\Requests\UserBalance;
use DMarketAuthApi\Requests\UserInventory;
use DMarketAuthApi\Requests\UserItems;
use DMarketAuthApi\Requests\UserOffers;
use DMarketAuthApi\Requests\UserProfile;
use DMarketAuthApi\Requests\UserTargets;
use DMarketAuthApi\Requests\WithdrawAssets;

class DMarketAuthApi
{
    private string $publicKey;
    private string $secretKey;

    public function __construct($publicKey, $secretKey)
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
    }


    //Account
    public function getUserProfile(array $proxy = [])
    {
        $class = new UserProfile();

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function getUserBalance(array $proxy = [])
    {
        $class = new UserBalance();

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }



    //Sell Items
    public function depositAssets(array $postParams, array $proxy = [])
    {
        $class = new DepositAssets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }

    public function getDepositStatus(string $depositId, array $proxy = [])
    {
        $class = new DepositStatus($depositId);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function getUserOffers(array $queries = [], array $proxy = [])
    {
        $class = new UserOffers($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function createUserOffers(array $postParams, array $proxy = [])
    {
        $class = new CreateUserOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }

    public function editUserOffers(array $postParams, array $proxy = [])
    {
        $class = new EditUserOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }

    public function getMarketItems(array $queries, array $proxy = [])
    {
        $class = new MarketItems($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function deleteOffers(array $postParams, array $proxy = [])
    {
        $class = new DeleteOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }



    //Inventory/items
    public function getUserInventory(array $queries = [], array $proxy = [])
    {
        $class = new UserInventory($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function syncUserInventory(array $postParams, array $proxy = [])
    {
        $class = new SyncUserInventory();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }

    public function withdrawAssets(array $postParams, array $proxy = [])
    {
        $class = new WithdrawAssets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }

    public function getUserItems(array $queries, array $proxy = [])
    {
        $class = new UserItems($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }



    //Buy items
    public function getOffersByTitle(array $queries, array $proxy = [])
    {
        $class = new OffersByTitle($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function getAggregatedPrices(array $queries, array $proxy = [])
    {
        $class = new AggregatedPrices($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function getUserTargets(array $queries = [], array $proxy = [])
    {
        $class = new UserTargets($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function getClosedUserTargets(array $queries = [], array $proxy = [])
    {
        $class = new ClosedUserTargets($queries);

        return $class->call($this->publicKey, $this->secretKey, $proxy)->response();
    }

    public function createUserTargets(array $postParams, array $proxy = [])
    {
        $class = new CreateUserTargets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }

    public function deleteUserTargets(array $postParams, array $proxy = [])
    {
        $class = new DeleteUserTargets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }

    public function buyOffers(array $postParams, array $proxy = [])
    {
        $class = new BuyOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $proxy)->response();
    }
}