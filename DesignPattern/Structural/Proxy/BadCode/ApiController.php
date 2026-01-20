<?php

namespace DesignPattern\Structural\Proxy\BadCode;

class ApiController
{
    protected $userService;
    protected $productService;

    public function __construct(UserService $userService, ProductService $productService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
    }

    /**
     * ❌ BAD: Every request hits the remote API
     * If 100 users visit this page, API is called 100 times!
     */
    public function getProducts()
    {
        // ❌ Slow! Calls API every time
        $products = $this->productService->getProducts() ;
        return response()->json($products) ;
    }


    /**
     * ❌ BAD: Multiple API calls in one request
     */
    public function getDashboard()
    {
        // ❌ Call 1: Get products
        $products = $this->productService->getProducts();

        // ❌ Call 2: Get users
        $users = $this->userService->getUsers();

        // ❌ Total: 3 slow API calls!
        return response()->json([
            'products' => $products,
            'users' => $users,
        ]);
    }
}


/**
 * ============================================
 * PROBLEMS WITH BAD CODE:
 * ============================================
 *
 * 1. PERFORMANCE ISSUES:
 *    ❌ Every request = API call
 *    ❌ Very slow response times
 *    ❌ User waits for remote API every time
 *
 * 2. RESOURCE INTENSIVE:
 *    ❌ Wastes bandwidth
 *    ❌ Wastes server resources
 *    ❌ Wastes remote API resources
 *
 * 3. HIGH API LOAD:
 *    ❌ Hammers remote API with requests
 *    ❌ May hit rate limits
 *    ❌ May get blocked
 *
 * 4. NO CACHING:
 *    ❌ Same data fetched repeatedly
 *    ❌ No memory of previous requests
 *
 * 5. POOR USER EXPERIENCE:
 *    ❌ Slow page loads
 *    ❌ Delays on every click
 *
 * EXAMPLE:
 * - User visits product page: 500ms (API call)
 * - User refreshes: 500ms (API call again!)
 * - 10 users visit: 10 API calls for same data!
 *
 * ============================================
 * SOLUTION: USE PROXY PATTERN!
 * ============================================
 */
