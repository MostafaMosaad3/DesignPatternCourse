<?php

namespace DesignPattern\Structural\Proxy\GoodCode;

use DesignPattern\Structural\Proxy\GoodCode\Contracts\ProductServiceInterface;
use DesignPattern\Structural\Proxy\GoodCode\Contracts\UserServiceInterface;

/**
 * ✅ GOOD: Depends on interface, not implementation
 * Can be RealService or Proxy - doesn't matter!
 */

class ApiController
{
    protected $productService;
    protected $userService;

    /**
     * ✅ GOOD: Depends on interface, not implementation
     * Can be RealService or Proxy - doesn't matter!
     */
    public function __construct(
        ProductServiceInterface $productService,
        UserServiceInterface $userService
    ) {
        $this->productService = $productService;
        $this->userService = $userService;
    }

    /**
     * ✅ GOOD: First request = API call
     * Subsequent requests = cached (fast!)
     */
    public function getProducts()
    {
        // Uses proxy automatically
        $products = $this->productService->getProducts();

        return response()->json($products);
    }

    /**
     * ✅ GOOD: Multiple calls, but cached!
     */
    public function getDashboard()
    {
        // First time: 2 API calls
        // After that: All cached! Super fast!
        $products = $this->productService->getProducts();
        $users = $this->userService->getUsers();


        return response()->json([
            'products' => $products,
            'users' => $users,
        ]);
    }
}

/**
 * ============================================
 * ADVANTAGES OF PROXY PATTERN:
 * ============================================
 *
 * 1. CACHING (Main Benefit):
 *    ✅ First request: Calls API
 *    ✅ Next requests: Returns cached data
 *    ✅ Dramatically faster
 *
 * 2. SAME INTERFACE:
 *    ✅ Proxy implements same interface
 *    ✅ Client doesn't know it's using proxy
 *    ✅ Can swap Real Service ↔ Proxy easily
 *
 * 3. REDUCED API LOAD:
 *    ✅ Fewer requests to remote API
 *    ✅ Saves bandwidth
 *    ✅ Saves API quota
 *
 * 4. BETTER PERFORMANCE:
 *    ✅ Fast response times
 *    ✅ Better user experience
 *    ✅ Less waiting
 *
 * 5. TRANSPARENT:
 *    ✅ Controller doesn't change
 *    ✅ Just dependency injection change
 *    ✅ Easy to enable/disable
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * SCENARIO: Dashboard loads products, users, and featured product
 *
 * BAD CODE (Without Proxy):
 * ❌ First visit: 3 API calls (1500ms)
 * ❌ Refresh page: 3 API calls (1500ms)
 * ❌ 10 users visit: 30 API calls!
 * ❌ Slow, expensive, hammers API
 *
 * GOOD CODE (With Proxy):
 * ✅ First visit: 3 API calls (1500ms)
 * ✅ Refresh page: 0 API calls (3ms) - cached!
 * ✅ 10 users visit: 3 API calls total!
 * ✅ Fast, efficient, API-friendly
 *
 * PERFORMANCE IMPROVEMENT:
 * - First request: Same speed
 * - Subsequent requests: 500x faster!
 * - API calls reduced: 90%+
 *
 * That's the power of Proxy Pattern! 🚀
 * It acts as a smart middleman between client and remote service!
 */
