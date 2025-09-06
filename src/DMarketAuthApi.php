<?php

namespace DMarketAuthApi;

use DMarketAuthApi\Requests\AggregatedPrices;
use DMarketAuthApi\Requests\AppraiseTargets;
use DMarketAuthApi\Requests\BuyOffers;
use DMarketAuthApi\Requests\ClosedUserOffers;
use DMarketAuthApi\Requests\ClosedUserTargets;
use DMarketAuthApi\Requests\CreateUserOffers;
use DMarketAuthApi\Requests\CreateUserOffersV2;
use DMarketAuthApi\Requests\CreateUserTargets;
use DMarketAuthApi\Requests\CustomizedFees;
use DMarketAuthApi\Requests\DeleteOffers;
use DMarketAuthApi\Requests\DeleteUserTargets;
use DMarketAuthApi\Requests\DepositAssets;
use DMarketAuthApi\Requests\DepositStatus;
use DMarketAuthApi\Requests\EditUserOffers;
use DMarketAuthApi\Requests\EditUserTargets;
use DMarketAuthApi\Requests\History;
use DMarketAuthApi\Requests\LastSales;
use DMarketAuthApi\Requests\MarketItems;
use DMarketAuthApi\Requests\OffersByTitle;
use DMarketAuthApi\Requests\SyncUserInventory;
use DMarketAuthApi\Requests\TargetsByTitle;
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

    private bool $detailed = false;

    public function __construct($publicKey, $secretKey)
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
    }

    /**
     * @return $this
     */
    public function detailed(): DMarketAuthApi
    {
        $this->detailed = true;
        return $this;
    }


    // Account
    /**
     * @throws \SodiumException
     */
    public function getUserProfile(array $proxy = [])
    {
        $class = new UserProfile();

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getUserBalance(array $proxy = [])
    {
        $class = new UserBalance();

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }



    // Sell Items
    /**
     * @throws \SodiumException
     */
    public function depositAssets(array $postParams, array $proxy = [])
    {
        $class = new DepositAssets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getDepositStatus(string $depositId, array $proxy = [])
    {
        $class = new DepositStatus($depositId);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getUserOffers(array $queries = [], array $proxy = [])
    {
        $class = new UserOffers($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function createUserOffers(array $postParams, array $proxy = [])
    {
        $class = new CreateUserOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function editUserOffers(array $postParams, array $proxy = [])
    {
        $class = new EditUserOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getMarketItems(array $queries, array $proxy = [])
    {
        $class = new MarketItems($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function deleteOffers(array $postParams, array $proxy = [])
    {
        $class = new DeleteOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }



    // Inventory/items
    /**
     * @throws \SodiumException
     */
    public function getUserInventory(array $queries = [], array $proxy = [])
    {
        $class = new UserInventory($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function syncUserInventory(array $postParams, array $proxy = [])
    {
        $class = new SyncUserInventory();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function withdrawAssets(array $postParams, array $proxy = [])
    {
        $class = new WithdrawAssets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getUserItems(array $queries, array $proxy = [])
    {
        $class = new UserItems($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getCustomizedFees(array $queries, array $proxy = [])
    {
        $class = new CustomizedFees($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }




    // Sold user items
    /**
     * @throws \SodiumException
     */
    public function getClosedUserOffers(array $queries = [], array $proxy = [])
    {
        $class = new ClosedUserOffers($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }




    // Buy items
    /**
     * @throws \SodiumException
     */
    public function getOffersByTitle(array $queries, array $proxy = [])
    {
        $class = new OffersByTitle($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getTargetsByTitle(string $gameId, string $title, array $proxy = [])
    {
        $class = new TargetsByTitle($gameId, $title);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getAggregatedPrices(array $queries, array $proxy = [])
    {
        $class = new AggregatedPrices($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getUserTargets(array $queries = [], array $proxy = [])
    {
        $class = new UserTargets($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function getClosedUserTargets(array $queries = [], array $proxy = [])
    {
        $class = new ClosedUserTargets($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function createUserTargets(array $postParams, array $proxy = [])
    {
        $class = new CreateUserTargets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function editUserTargets(array $postParams, array $proxy = [])
    {
        $class = new EditUserTargets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }


    /**
     * @throws \SodiumException
     */
    public function deleteUserTargets(array $postParams, array $proxy = [])
    {
        $class = new DeleteUserTargets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @throws \SodiumException
     */
    public function buyOffers(array $postParams, array $proxy = [])
    {
        $class = new BuyOffers();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }



    // Aggregator
    /**
     * @throws \SodiumException
     */
    public function getLastSales(array $queries, array $proxy = [])
    {
        $class = new LastSales($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }



    // Unofficial

    /**
     * @param array $postParams
     * @param array $proxy
     * @return mixed
     * @throws \SodiumException
     */
    public function appraiseTargets(array $postParams, array $proxy = [])
    {
        $class = new AppraiseTargets();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }

    /**
     * @param array $queries
     * @param array $proxy
     * @return mixed
     * @throws \SodiumException
     */
    public function getHistory(array $queries = [], array $proxy = [])
    {
        $class = new History($queries);

        return $class->call($this->publicKey, $this->secretKey, $this->detailed, $proxy)->response();
    }

    /**
     * @param array $postParams
     * @param array $proxy
     * @return mixed
     * @throws \SodiumException
     */
    public function createUserOffersV2(array $postParams, array $proxy = [])
    {
        $class = new CreateUserOffersV2();

        return $class->call($this->publicKey, $this->secretKey, $postParams, $this->detailed, $proxy)->response();
    }
}