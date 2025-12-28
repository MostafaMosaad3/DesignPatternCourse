<?php

namespace DesignPattern\Iterator\GoodCode\Contracts;

// ============================================
// STEP 2: AGGREGATE INTERFACE
// ============================================

/**
 * EmployeeCollection Interface (Collection Interface)
 * Defines the contract for collections that can be iterated
 */
interface EmployeeCollection
{
    /**
     * Create and return an iterator for this collection
     */
    public function createIterator(): EmployeeIterator;
}
