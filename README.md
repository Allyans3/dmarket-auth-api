# Unofficial DMarket Auth API

Installation
------------

### With composer

Run this text in console to install this package:

```
composer require allyans3/dmarket-auth-api
```

This package currently offers 23 API calls you can make to DMarket.


Creating new object
-------------------

```php
//Replace with your own keys
$publicKey = "8397eb8e7f88032eb13dca99a11350b05d290c896a96afd60b119184b1b443c9";
$secretKey = "2de2824ac1752d0ed3c66abc67bec2db553022aa718287a1e773e104303031208397eb8e7f88032eb13dca99a11350b05d290c896a96afd60b119184b1b443c9";

$api = new DMarketAuthApi($publicKey, $secretKey);
```

Methods
-------------------

```php
// Used to get detailed response
$api->detailed()->getUserProfile()

// Account
$api->getUserProfile(array $proxy = [])
$api->getUserBalance(array $proxy = [])

// Sell Items
$api->depositAssets(array $postParams, array $proxy = [])
$api->getDepositStatus(string $depositId, array $proxy = [])
$api->getUserOffers(array $queries = [], array $proxy = [])
$api->createBatchOffers(array $postParams, array $proxy = [])
$api->updateBatchOffers(array $postParams, array $proxy = [])
$api->deleteBatchOffers(array $postParams, array $proxy = [])
$api->getMarketItems(array $queries, array $proxy = [])

️️❗️//Old endpoints will be deprecated in 2–3 weeks. So please make migration in advance.
$api->createUserOffers(array $postParams, array $proxy = [])
$api->editUserOffers(array $postParams, array $proxy = [])
$api->deleteOffers(array $postParams, array $proxy = [])

// Inventory/items
$api->getUserInventory(array $queries = [], array $proxy = [])
$api->syncUserInventory(array $postParams, array $proxy = [])
$api->withdrawAssets(array $postParams, array $proxy = [])
$api->getUserItems(array $queries, array $proxy = [])
$api->getCustomizedFees(array $queries, array $proxy = [])

// Sold user items
$api->getClosedUserOffers(array $queries = [], array $proxy = [])

// Buy items
$api->getOffersByTitle(array $queries, array $proxy = [])
$api->getTargetsByTitle(string $gameId, string $title, array $proxy = [])
$api->getAggregatedPrices(array $queries, array $proxy = [])
$api->getAggregatedPricesV2(array $postParams, array $proxy = [])
$api->getUserTargets(array $queries = [], array $proxy = [])
$api->getClosedUserTargets(array $queries = [], array $proxy = [])
$api->createUserTargets(array $postParams, array $proxy = [])
$api->deleteUserTargets(array $postParams, array $proxy = [])
$api->buyOffers(array $patchParams, array $proxy = [])

// Aggregator
$api->getLastSales(array $queries, array $proxy = [])
```

Documentation
-------------

https://docs.dmarket.com/v1/swagger.html
