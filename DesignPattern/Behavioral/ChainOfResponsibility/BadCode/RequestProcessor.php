<?php

namespace DesignPatterns\ChainOfResponsibility\BadCode;

// ============================================
// REQUEST PROCESSOR (MONOLITHIC)
// ============================================


class RequestProcessor
{
    /**
     * ❌ BAD: All checks in ONE method
     * ❌ Nested if statements
     * ❌ Can't reuse individual checks
     */

    public function handle(Request $request) :bool
    {
        // Check 1: Authentication
        if(!$this->isAuthenticated($request)){
            return false;
        }

        // Check 2: Authorization
        if(!$this->isAuthorized($request)){
            return false;
        }

        // Check 3: Security
        if(!$this->isSecured($request)){
            return false;
        }

        // All checks passed
        return true;
    }


    /**
     * Check if user is authenticated
     */
    private function isAuthenticated(Request $request) : bool
    {
        return !empty($request->token);
    }


    /**
     * Check if user has permission
     */
    private function isAuthorized(Request $request) : bool
    {
        return $request->role === 'admin' ;
    }

    /**
     * Check for security threats
     */
    private function isSecured(Request $request) : bool
    {
        return !isset($request->data['malicious']);
    }

}



/**
 * ============================================
 * PROBLEMS WITH THIS CODE:
 * ============================================
 *
 * 1. MONOLITHIC METHOD:
 *    ❌ handle() does all 3 checks
 *    ❌ Add new check? Modify handle()
 *    ❌ Remove check? Modify handle()
 *
 * 2. HARD TO REORDER:
 *    ❌ Want security before auth? Cut/paste code
 *    ❌ Risk breaking logic
 *
 * 3. HARD TO REUSE:
 *    ❌ Want only auth check elsewhere? Can't!
 *    ❌ Must copy-paste method
 *
 * 4. HARD TO TEST:
 *    ❌ Can't test auth separately
 *    ❌ Must test entire handle() method
 *
 * 5. VIOLATES OPEN/CLOSED:
 *    ❌ Add rate limiting? Must modify handle()
 *    ❌ Production code changes every time
 *
 * ============================================
 * SOLUTION: USE CHAIN OF RESPONSIBILITY!
 * ============================================
 *
 * See GOOD CODE for proper implementation
 */
