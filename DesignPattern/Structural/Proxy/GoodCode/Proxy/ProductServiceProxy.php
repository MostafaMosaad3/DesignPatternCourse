<?php

namespace DesignPattern\Structural\Proxy\GoodCode\Proxy;

use DesignPattern\Structural\Proxy\GoodCode\Contracts\ProductServiceInterface;
use DesignPattern\Structural\Proxy\GoodCode\Services\RealProductService;

class ProductServiceProxy implements ProductServiceInterface
{

    Protected $realService ;
    protected $cache = []; // ✅ In-memory cache
    protected $cacheTime = 300; // 5 minutes


    public function __construct(RealProductService $realService)
    {
        $this->realService = $realService;
    }

    /**
     * ✅ GOOD: Checks cache first!
     * Only calls API if not cached
     */
    public function getProducts() :array
    {
        $cacheKey = 'products_all' ;

        // ✅ Check cache first
        if ($this->isCached($cacheKey)) {
            return $this->getFromCache($cacheKey);
        }

        // ❌ Not cached, fetch from API
        $data = $this->realService->getProducts();

        // ✅ Store in cache for next time
        $this->saveToCache($cacheKey, $data);

        return $data;
    }


    public function isCached(string $key) :bool
    {
        if(!isset($this->cache[$key])) {
            return false;
        }

        // Check if cache expired
        $cacheData = $this->cache[$key];
        $isExpired = time() > $cacheData['expires_at'];

        if ($isExpired) {
            unset($this->cache[$key]);
            return false;
        }

        return true;
    }


    protected function getFromCache(string $key): array
    {
        return $this->cache[$key]['data'];
    }

    protected function saveToCache(string $key, array $data): void
    {
        $this->cache[$key] = [
            'data' => $data,
            'expires_at' => time() + $this->cacheTime
        ];
    }
}
