<?php

namespace DesignPattern\Structural\Proxy\BadCode;

use Illuminate\Support\Facades\Http;

class UserService
{
    /**
     * ❌ BAD: Fetches users every time
     */

    public function getUsers() :array
    {
        // ❌ Always calls remote API
        $response = Http::get('https://dummyjson.com/users') ;
        return $response->json();
    }
}
