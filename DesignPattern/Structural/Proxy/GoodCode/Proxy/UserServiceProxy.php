<?php

namespace DesignPattern\Structural\Proxy\GoodCode\Proxy;

use DesignPattern\Structural\Proxy\GoodCode\Contracts\UserServiceInterface;
use DesignPattern\Structural\Proxy\GoodCode\Services\RealUserService;

class UserServiceProxy implements UserServiceInterface
{

    protected $realService ;
    protected $cache = [] ;
    protected $cacheTime = 300 ;

    public function __construct(RealUserService $realService)
    {
        $this->realService = $realService;
    }
    public function getUsers(): array
    {
        $cacheKey = 'users_all' ;

        if($this->isCached($cacheKey))
        {
            return $this->getFromCache($cacheKey);
        }

        $data = $this->realService->getUsers();
        $this->saveToCache($cacheKey, $data);

        return $data;
    }

    public function isCached(string $key): bool
    {
        if(!isset($this->cache[$key]))
        {
            return false;
        }

        $cacheData = $this->cache[$key];
        return time() <= $cacheData['expires_at'];
    }


    public function getFromCache(string $key)
    {
        return $this->cache[$key]['data'];
    }

    public function saveToCache(string $key, $data)
    {
        $this->cache[$key] =
        [
            'data' => $data,
            'expires_at' => time() + $this->cacheTime
        ];
    }


}
