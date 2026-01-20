<?php

namespace DesignPattern\Structural\Proxy\GoodCode\Contracts;

// ============================================
// GOOD CODE: WITH PROXY PATTERN
// ============================================

/**
 * BENEFITS:
 * ✅ Caches API responses
 * ✅ Fast repeated requests
 * ✅ Reduces API load
 * ✅ Better performance
 * ✅ Same interface as original service
 */

// ============================================
// SUBJECT INTERFACE
// ============================================

interface ProductServiceInterface
{
    public function getProducts() : array ;
}
