<?php

namespace DesignPattern\Structural\Proxy\GoodCode\Services;

use DesignPattern\Structural\Proxy\GoodCode\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Http;

class RealUserService implements UserServiceInterface
{

    public function getUsers(): array
    {
        $response = Http::get('https://dummyjson.com/users') ;
        return $response->json($response);
    }
}
