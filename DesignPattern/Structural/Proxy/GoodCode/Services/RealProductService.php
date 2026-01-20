<?php

namespace DesignPattern\Structural\Proxy\GoodCode\Services;

use DesignPattern\Structural\Proxy\GoodCode\Contracts\ProductServiceInterface;
use Illuminate\Support\Facades\Http;

// ============================================
// REAL SUBJECT: ACTUAL API SERVICE
// ============================================

class RealProductService implements ProductServiceInterface
{

    public function getProducts(): array
    {
        $response = Http::get('https://dummyjson.com/products') ;
        return $response->json($response);
    }
}
