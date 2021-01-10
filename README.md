# Unofficial DMarket Auth API

Installation
------------

### With composer

Run this text in console to install this package:

```
composer require allyans3/dmarket-auth-api
```

This package currently offers 20 API calls you can make to DMarket.


Creating new object
-------------------

```
//Replace with your own keys
$publicKey = "8397eb8e7f88032eb13dca99a11350b05d290c896a96afd60b119184b1b443c9";
$secretKey = "2de2824ac1752d0ed3c66abc67bec2db553022aa718287a1e773e104303031208397eb8e7f88032eb13dca99a11350b05d290c896a96afd60b119184b1b443c9";

$api = new DMarketAuthApi($publicKey, $secretKey);
```

Documentation
-------------

https://docs.dmarket.com/v1/swagger.html?_gl=1*11y6mqo*_ga*MzA5OTg5NDYuMTYwNTgyODc2Nw..*_ga_J73817TZWR*MTYxMDI5NzU4OC45MS4wLjE2MTAyOTc1OTAuNTg.