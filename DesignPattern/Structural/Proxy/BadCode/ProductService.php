<?php

namespace DesignPattern\Structural\Proxy\BadCode;


// ============================================
// BAD CODE: WITHOUT PROXY PATTERN
// ============================================
use Illuminate\Support\Facades\Http;

/**
 * PROBLEMS:
 * ❌ Calls remote API every time
 * ❌ No caching mechanism
 * ❌ Slow and resource-intensive
 * ❌ High load on remote API
 * ❌ Poor performance
 */

class ProductService
{
    /**
     * ❌ BAD: Fetches from API every single time
     * Even if the same data was just requested!
     */

    public function getProducts() :array
    {
        // ❌ Always calls remote API
        $response = Http::get('https://dummyjson.com/products') ;
        return $response->json();
    }
}
